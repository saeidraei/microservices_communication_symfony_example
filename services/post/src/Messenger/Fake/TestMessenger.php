<?php
namespace App\Messenger\Fake;

use App\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\Attribute\When;

#[When(env: 'test')]
class TestMessenger implements MessengerInterface{

    /**
     * @var callable null
     */
    public $assertCallback = null;

    public function publish(object $message)
    {
        $this->assertCallback && ($this->assertCallback)($message);
    }
}