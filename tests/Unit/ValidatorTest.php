<?php 

it('validates a string', function () {

    expect(\Core\Validator::string('foobar'))->toBeTrue();
    expect(\Core\Validator::string('false'))->toBeFalse();
    expect(\Core\Validator::string(''))->toBeFalse();

});