<?php

namespace App\Services;

use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Http\Request;

class VNPayService
{
    protected const EXCHANGE_RATE_VND = 24565;
    protected const STATUS_VNPAY_SUCCESS = '00';
    protected const VNPAY_AMOUNT_MULTIPLIER = 100;

    /**
     * @var CourseRepositoryInterface
     */
    protected $courseRepo;

    public function __construct(CourseRepositoryInterface $courseRepo)
    {
        $this->courseRepo = $courseRepo;
    }

    /**
     * Get url for payment with VN pay.
     *
     * @return string
     */
    public function getUrlPayment()
    {
        $orders = session()->get('cart');
        $courseIds = [];

        if (!empty($orders)) {
            foreach ($orders as $orderItem) {
                if (isset($orderItem['course_id'])) {
                    $courseIds[] = $orderItem['course_id'];
                }
            }
        }

        $totalPrice = $this->courseRepo->getTotalPriceOfCourses($courseIds);
        $priceVND = round($totalPrice * self::EXCHANGE_RATE_VND);
        $userID = auth()->id();
        $vnpUrl = env('VNP_URL');
        $vnpReturnurl = route('vnPay.processPaymentAndOrder');
        $vnpTmnCode = env('VNP_TMN_CODE');
        $vnpHashSecret = env('VNP_HASH_SECRET');
        $vnpTxnRef = $userID . time();
        $vnpOrderInfo = 'Payment with VN Pay';
        $vnpOrderType = 'billpayment';
        $vnpAmount = $priceVND * self::VNPAY_AMOUNT_MULTIPLIER;
        $vnpLocale = 'vn';
        $vnpBankCode = 'NCB';
        $vnpIpAddr = '127.0.0.1';
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnpTmnCode,
            "vnp_Amount" => $vnpAmount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_BankCode" => $vnpBankCode,
            "vnp_IpAddr" => $vnpIpAddr,
            "vnp_Locale" => $vnpLocale,
            "vnp_OrderInfo" => $vnpOrderInfo,
            "vnp_OrderType" => $vnpOrderType,
            "vnp_ReturnUrl" => $vnpReturnurl,
            "vnp_TxnRef" => $vnpTxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            }
            if ($i == 0) {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnpUrl = $vnpUrl . "?" . $query;

        if (isset($vnpHashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnpHashSecret);
            $vnpUrl .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnpUrl;
    }

    /**
     * Get payment success or fail.
     *
     * @param Request $request
     * @return boolean
     */
    public function checkPayment(Request $request)
    {
        $inputData = $request->all();

        if (!$this->checkSecureHash($inputData) || $inputData['vnp_ResponseCode'] != self::STATUS_VNPAY_SUCCESS) {
            return false;
        }

        if (!$this->checkPrice($inputData['vnp_Amount'])) {
            return false;
        }

        return true;
    }

    /**
     * Verifies the integrity and authenticity of input data
     * by comparing a computed hash with a provided secure hash.
     *
     * @param array $inputData
     * @return boolean
     */
    public function checkSecureHash($inputData)
    {
        $vnpHashSecret = env('VNP_HASH_SECRET');
        foreach ($inputData as $key => $value) {
            if (strpos($key, 'vnp_') === 0) {
                $inputData[$key] = $value;
            }
        }
        $vnpSecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            }
            if ($i == 0) {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            }
            $i = 1;
        }

        $hashData = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', $hashData, $vnpHashSecret);

        return $secureHash == $vnpSecureHash;
    }

    /**
     * Get payment success or fail.
     *
     * @param int $vnpAmount
     * @return boolean
     */
    public function checkPrice($vnpAmount)
    {
        $courseIds = [];
        $orders = session()->get('cart');

        if (!empty($orders)) {
            foreach ($orders as $orderItem) {
                if (isset($orderItem['course_id'])) {
                    $courseIds[] = $orderItem['course_id'];
                }
            }
        }

        $totalPrice = $this->courseRepo->getTotalPriceOfCourses($courseIds);
        $priceVND = round($totalPrice * self::EXCHANGE_RATE_VND);

        return $priceVND == $vnpAmount / self::VNPAY_AMOUNT_MULTIPLIER;
    }
}
