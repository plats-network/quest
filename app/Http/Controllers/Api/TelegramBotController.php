<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\v1\Controller;
use App\Space\Data\SamplePostData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    public function index()
    {
        $this->msg = 'API';
        $data = [
            'api_version' => '1.0',
        ];

        //Json
        return response()->json($data);
    }

    /*
     * Telegram Data
     * */
    public static function getSampleTelegramCommand($command = '/login')
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
                        'username' => 'username',
                        'language_code' => 'vi',
                    ],
                    'chat' => [
                        'id' => 123,
                        'first_name' => 'User',
                        'username' => 'username',
                        'type' => 'private',
                    ],
                    'date' => 1628659018,
                    //'text' => '/start',
                    'text' => '/id',

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

    /*
    * Telegram WebHook
     *
    * @created 2022/01/12
    * */
    public function handle(Request $request)
    {
        //Sample data
        $dataRequest = $request->all();
        if ($request->get('type') == 1 || empty($dataRequest)) {
            $dataSample = $this->getSampleTelegramCommand();

            $dataRequest = $dataSample;
        }

        //Telegram handle
        //$update = Telegram::commandsHandler(true);
        // Commands handler method returns an Update object.
        // So you can further process $update object
        // to however you want.

        //Log::info('Data', $dataRequest);

        $dataMessage = [];
        if (isset($dataRequest['message'])) {
            $dataMessage = $dataRequest['message'];
        } elseif (isset($dataRequest['edited_message'])) {
            $dataMessage = $dataRequest['edited_message'];
        } /*elseif (isset($dataRequest['my_chat_member'])) {
            $dataMessage = $dataRequest['my_chat_member'];
        }*/
        //Create new user
        //$this->saveTelegramUser($dataMessage);

        $isSendInfo = false;
        if ($isSendInfo) {
            if (isset($dataMessage['from'])) {
                $textLog = <<<HTML
<b>Thông tin User</b>

<b>ID {$dataMessage['from']['id']}</b>
<b>Tên {$dataMessage['from']['first_name']}</b>
<b>Username {$dataMessage['from']['id']}</b>
HTML;

                Telegram::sendMessage([
                    'chat_id' => config('telegram.admin_chat_id'),
                    'parse_mode' => 'HTML',
                    'text' => $textLog,
                ]);
            }
        }
        //Abort 404
        if (! $dataMessage) {
            //Log::info('No Data', $dataRequest);
            return [];
        }

        if (! $dataRequest['update_id']) {
            return [];
        }

        if (! isset($dataMessage['text'])) {
            return [];
        }

        $message = $dataMessage['text'];
        //$message = '/lesson 1.1 1';

        $parts = explode(' ', $message);

        //Start
        /*if ($parts[0] === '/start' || $parts[0] === '/batdau' || $parts[0] === '/help') {
            return $this->start($request, $dataMessage);
        }*/


        if ($parts[0] === '/id' || $parts[0] === '/maso') {
            $this->sendInfoID($dataMessage);
            Log::info('Data', $dataRequest);
        }


        return [];
    }

    //Telegram get getChatMember
    //Kick status
    //Telegram\Bot\Objects\ChatMember {#2449 ▼ // app\Http\Controllers\Api\TelegramBotController.php:171
    //  #items: array:3 [▼
    //    "user" => array:5 [▼
    //      "id" => 5176914547
    //      "is_bot" => false
    //      "first_name" => "Trân"
    //      "last_name" => "Chính"
    //      "username" => "TranChinh2001"
    //    ]
    //    "status" => "kicked" //creator, administrator, member, restricted, left, kicked
    //    "until_date" => 0
    //  ]
    //  #escapeWhenCastingToString: false
    //}
    public function getChatMember($chat_id ='', $user_id = '')
    {
        //Get Update
        //$activity = Telegram::getUpdates();
        //dd($activity);
        $isJoin = false;

        //$chat_id = -4132667207;
        $chat_id = -1002018192831;

        $UserID1 = '706659637';
        $UserID2 = '5176914547';
        $UserID3 = '5211022547'; //Ro
        //ID Channel Quest
        $idChannel = -1002016740151;
        $idChannel2 = -1002018192831;
        $user_id = 706659637;
        try{
            $response = Telegram::getChatMember([
                'chat_id' => $chat_id,
                'user_id' => 706659637,
            ]);
            //Telegram\Bot\Objects\ChatMember {#2449 ▼ // app\Http\Controllers\Api\TelegramBotController.php:188
            //  #items: array:3 [▼
            //    "user" => array:5 [▼
            //      "id" => 706659637
            //      "is_bot" => false
            //      "first_name" => "Dung X10"
            //      "username" => "xuandungx10"
            //      "language_code" => "en"
            //    ]
            //    "status" => "creator"
            //    "is_anonymous" => false
            //  ]
            //  #escapeWhenCastingToString: false
            //}
            //dd($response);

            $arrStatusJoin = ['creator', 'administrator', 'member', 'restricted'];
            //Check member is join
            if ($response->status && in_array($response->status, $arrStatusJoin)) {
                $isJoin = true;
            }

        } catch (\Exception $e) {
            //User not found
            dd($e->getMessage());
        }

        dd($isJoin);
        return $isJoin;
        //dd($response);
    }

    /*
    * ID Group
    * */
    protected function sendInfoID($dataMessage)
    {
        $telegram_id = $dataMessage['from']['id'];

        $idGroup = isset($dataMessage['chat']) ? $dataMessage['chat']['id'] : null;
        //Send message
        Telegram::sendMessage([
            'chat_id' => $telegram_id,
            'parse_mode' => 'HTML',
            'text' => 'ID group:'.$idGroup,
        ]);

        //Send ID To group
        if ($idGroup) {
            Telegram::sendMessage([
                'chat_id' => $idGroup,
                'parse_mode' => 'HTML',
                'text' => 'ID group:'.$idGroup,
            ]);
        }
    }

    public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
    }


    /*
     * Chat id 706659637
     * */
    public function sendMessage(Request $request)
    {
        $markdownText = '
        *bold \*text*
_italic \*text_
__underline__
~strikethrough~
*bold _italic bold ~italic bold strikethrough~ __underline italic bold___ bold*
[inline URL](http://www.example.com/)
[inline mention of a user](tg://user?id=123456789)
`inline fixed-width code`
```
pre-formatted fixed-width code block
```
```python
pre-formatted fixed-width code block written in the Python programming language
```
        ';

        //Send messsage
        /*Telegram::sendMessage([
            //'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'chat_id' => config('telegram.admin_chat_id'),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);*/
        Telegram::sendMessage([
            //'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
           // 'chat_id' => config('telegram.admin_chat_id'),
            'chat_id' => -1002018192831,
            'parse_mode' => 'MarkdownV2',
            'text' => $markdownText,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Send message success',
        ]);
    }

    /*
     * Config
     * Webhook
     *
     * */
    public function setConfigData(Request $request)
    {
        $url = 'https://hackathon.plats.quest/telegram/LkBUQR2ZYbqt74ch';

        $url = $request->get('url', $url);

        Telegram::setWebhook([
            'url' => $url,
        ]);

        //Send messsage success to telegram
        Telegram::sendMessage([
            //'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'chat_id' => config('telegram.admin_chat_id'),
            'parse_mode' => 'HTML',
            'text' => 'Set webhook success to url:'. $url,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Send message success',
        ]);
    }

    /*
  * Config
  * Webhook
  *
  * */
    public function getWebhookInfo()
    {
        $url = 'https://hackathon.plats.quest//telegram/LkBUQR2ZYbqt74ch';

        $activity = Telegram::getUpdates();
        dd($activity);
    }
}
