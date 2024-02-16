<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
class TelegramController extends  Controller
{

    //setWebhook
    public function setWebhook()
    {
        $response = Telegram::setWebhook(['url' => 'https://example.com/<token>/webhook']);

        # Or if you are supplying a self-signed-certificate
        $response = Telegram::setWebhook([
            'url' => 'https://example.com/<token>/webhook',
            'certificate' => '/path/to/public_key_certificate.pub'
        ]);
    }

    //Webhook Update
    public function webhookUpdate(Request $request)
    {
        $updates = Telegram::getWebhookUpdate();
        //Sample data
        $dataRequest = $request->all();
        if ($request->get('type') == 1 || empty($dataRequest)) {
            $dataSample = $this->getSampleTelegramCommand();

            $dataRequest = $dataSample;
        }

        $dataMessage = [];
        if (isset($dataRequest['message'])) {
            $dataMessage = $dataRequest['message'];
        } elseif (isset($dataRequest['edited_message'])) {
            $dataMessage = $dataRequest['edited_message'];
        }

        if (! $dataMessage) {
            //Log::info('No Data', $dataRequest);
            return [];
        }
        $message = $dataMessage['text'];
        $parts = explode(' ', $message);
    }

    /*
  * Telegram Data
  * */
    public function getSampleTelegramCommand($command = '/login')
    {
        $dataSample =
            [
                'update_id' => 684768049,
                'message_id' => 2552,
                'message' => [
                    'message_id' => 698,
                    'from' => [
                        'id' => 123,
                        'is_bot' => false,
                        'first_name' => 'User',
                        'username' => 'user',
                        'language_code' => 'vi',
                    ],
                    'chat' => [
                        'id' => 123,
                        'first_name' => 'User',
                        'username' => 'user',
                        'type' => 'private',
                    ],
                    'date' => 1628656018,
                    //'text' => '/start',
                    'text' => '/List',
                    'entities' => [
                        [
                            'offset' => 0,
                            'length' => 9,
                            'type' => 'bot_command',
                        ],
                    ],
                ],
            ];

        return $dataSample;
    }
}
