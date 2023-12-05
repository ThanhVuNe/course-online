<?php

namespace Tests\Unit\Service;

use App\Http\Requests\StoreTopicRequest;
use App\Models\Topic;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use App\Services\TopicService;
use Mockery;
use PHPUnit\Framework\TestCase;

class TopicServiceTest extends TestCase
{
    /**
     * @var TopicService
     */
    protected $topicService;
    protected $mockTopic;

    public function setUp(): void
    {
        $this->mockTopic = Mockery::mock(TopicRepositoryInterface::class)->makePartial();
        parent::setUp();
    }
    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function test_create_topic_success()
    {
        $courseId = 1;
        $request = Mockery::mock(StoreTopicRequest::class);
        $validatedData = [
            'name' => 'Test Topic',
            'course_id' => $courseId
        ];

        $request->shouldReceive('validated')->andReturn($validatedData);

        $this->mockTopic->shouldReceive('create')->once()->with($validatedData)->andReturn(new Topic($validatedData));

        $this->topicService = new TopicService($this->mockTopic);

        $topic = $this->topicService->create($request);

        $this->assertInstanceOf(Topic::class, $topic);

        $this->assertEquals(new Topic($validatedData), $topic);
    }
}
