var found = [];
$("select > option").each(function() {
if($.inArray(this.value, found) != -1) $(this).remove();
    found.push(this.value);
});
