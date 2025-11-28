<?php

namespace App\Console\Commands;

use App\Events\AsteriskBridgeEnter;
use App\Events\AsteriskBridgeLeave;
use App\Events\AsteriskDialBegin;
use App\Events\AsteriskDialEnd;
use App\Events\AsteriskHangupRequest;
use App\Events\AsteriskNewCallerID;
use App\Events\AsteriskNewChannel;
use App\Events\AsteriskQueueCallerJoin;
use App\Events\AsteriskVarSet;
use Illuminate\Console\Command;
use PAMI\Client\Impl\ClientImpl as PamiClient;
use PAMI\Message\Event\EventMessage;
use PAMI\Message\Action\LoginAction;
use PAMI\Message\Action\PingAction;
use App\Events\AsteriskIncomingCall;
use App\Events\AsteriskHangup;

class AsteriskListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asterisk:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen to Asterisk AMI events continuously';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $options = [
            'host' => '127.0.0.1',
            'scheme' => 'tcp://',
            'port' => 5038,
            'username' => 'amiuser',
            'secret' => 'amipassword',
            'connect_timeout' => 10000,
            'read_timeout' => 10000
        ];

        $client = new PamiClient($options);
        $client->open();

        $this->info("📡 Connected to Asterisk AMI…");

        while (true) {
            usleep(1000);

            $response = $client->process();

            if ($response instanceof EventMessage) {
                $eventName = $response->getName();

                switch ($eventName) {

                    // --- Call lifecycle ---
                    case 'Newchannel':
                        event(new AsteriskNewChannel($response->getKeys()));
                        break;

                    case 'NewCallerid':
                        event(new AsteriskNewCallerID($response->getKeys()));
                        break;

                    case 'Hangup':
                        event(new AsteriskHangup($response->getKeys()));
                        break;

                    case 'HangupRequest':
                        event(new AsteriskHangupRequest($response->getKeys()));
                        break;

                    case 'DialBegin':
                        event(new AsteriskDialBegin($response->getKeys()));
                        break;

                    case 'DialEnd':
                        event(new AsteriskDialEnd($response->getKeys()));
                        break;

                    case 'VarSet':
                        event(new AsteriskVarSet($response->getKeys()));
                        break;

                    // --- Queue events ---
                    case 'QueueCallerJoin':
                        event(new AsteriskQueueCallerJoin($response->getKeys()));
                        break;

                    case 'QueueCallerLeave':
                        event(new AsteriskQueueCallerLeave($response->getKeys()));
                        break;

                    case 'QueueMemberAdded':
                        event(new AsteriskQueueMemberAdded($response->getKeys()));
                        break;

                    case 'QueueMemberRemoved':
                        event(new AsteriskQueueMemberRemoved($response->getKeys()));
                        break;

                    case 'QueueMemberPaused':
                        event(new AsteriskQueueMemberPaused($response->getKeys()));
                        break;

                    case 'QueueMemberStatus':
                        event(new AsteriskQueueMemberStatus($response->getKeys()));
                        break;

                    case 'AgentCalled':
                        event(new AsteriskAgentCalled($response->getKeys()));
                        break;

                    case 'AgentConnect':
                        event(new AsteriskAgentConnect($response->getKeys()));
                        break;

                    case 'AgentComplete':
                        event(new AsteriskAgentComplete($response->getKeys()));
                        break;

                    // --- Bridge events ---
                    case 'BridgeCreate':
                        event(new AsteriskBridgeCreate($response->getKeys()));
                        break;

                    case 'BridgeEnter':
                        event(new AsteriskBridgeEnter($response->getKeys()));
                        break;

                    case 'BridgeLeave':
                        event(new AsteriskBridgeLeave($response->getKeys()));
                        break;

                    case 'BridgeDestroy':
                        event(new AsteriskBridgeDestroy($response->getKeys()));
                        break;

                    default:
                        // You may log unknown events
                        // Log::info("Unhandled Asterisk event", $response->getKeys());
                        break;
                }
            }
        }

        $client->close();
    }
}
