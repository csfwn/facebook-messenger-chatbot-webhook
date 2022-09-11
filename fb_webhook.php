<?php

$my_verify_token = "<VERIFY_TOKEN>";
$challenge = $_GET['hub_challenge'];
$verify_token = $_GET['hub_verify_token'];

if ($my_verify_token === $verify_token) {
    echo $challenge;
    exit;
}

$access_token = '<ACCESS_TOKEN>';

$response = file_get_contents("php://input");

file_put_contents("text.text", $response);

$response = json_decode($response, true);

$getStarted = "{ 
    'get_started':{
        'payload': 'get_started'
    }
  }";

getStarted($access_token, $getStarted);

$message = strtoupper(trim($response['entry'][0]['messaging'][0]['message']['text']));

$postback = strtoupper(trim($response['entry'][0]['messaging'][0]['postback']['payload']));

foreach ($response['entry'] as $entry) {
    if (isset($entry['messaging']) && is_array($entry['messaging'])) {
        foreach ($entry['messaging'] as $messaging) {
            handlePageMessaging($messaging, $message, $access_token, $postback);
        }
    }
}

function handlePageMessaging($messaging, $message, $access_token, $postback)
{
    if (isset($messaging['sender'], $messaging['sender']['id'])) {
        $senderId = $messaging['sender']['id'];
    }

    if ($postback &&  $postback == 'GET_STARTED') {
        $reply_message = "{
            'messaging_type': 'RESPONSE',
            'recipient' : {
                'id' : $senderId
            },
            'message' : {
                'text' : 'Hi welcome to messenger test chatbot, thank for your message!!!!!. Choose the action below to continue ;)',
                'quick_replies': [
                    {
                        'content_type': 'text',
                        'title': 'Info',
                        'payload': 'product'
                    },
                    {
                        'content_type': 'text',
                        'title': 'Product',
                        'payload': 'product'
                    },
                    {
                        'content_type': 'text',
                        'title': 'Receipt',
                        'payload': 'receipt'
                    },
                    {
                        'content_type': 'text',
                        'title': 'How To Buy',
                        'payload': 'how_to_buy'
                    },
                ]
            },
            
        }";

        sendReply($access_token, $reply_message);
    }

    if ($message == 'HELLO' || $message == 'HI') {
        $reply_message = "{
            'messaging_type': 'RESPONSE',
            'recipient' : {
                'id' : $senderId
            },
            'message' : {
                'text' : 'Hi welcome to messenger test chatbot, thank for your message!!!!!. Choose the action below to continue ;)',
                'quick_replies': [
                    {
                        'content_type': 'text',
                        'title': 'Info',
                        'payload': 'product'
                    },
                    {
                        'content_type': 'text',
                        'title': 'Product',
                        'payload': 'product'
                    },
                    {
                        'content_type': 'text',
                        'title': 'Receipt',
                        'payload': 'receipt'
                    },
                    {
                        'content_type': 'text',
                        'title': 'How To Buy',
                        'payload': 'how_to_buy'
                    },
                ]
            },
            
        }";

        sendReply($access_token, $reply_message);
    }

    if ($message == 'INFO') {
        $reply_message = "{
            'messaging_type': 'RESPONSE',
            'recipient' : {
                'id' : $senderId
            },
            'message' : {
                'text' : 'This platform provide conveniences to purchase products through our Media Social platforms.',
                'quick_replies': [
                    {
                        'content_type': 'text',
                        'title': 'Info',
                        'payload': 'product'
                    },
                    {
                        'content_type': 'text',
                        'title': 'Product',
                        'payload': 'product'
                    },
                    {
                        'content_type': 'text',
                        'title': 'Receipt',
                        'payload': 'receipt'
                    },
                    {
                        'content_type': 'text',
                        'title': 'How To Buy',
                        'payload': 'how_to_buy'
                    },
                ]
            },
            
        }";

        sendReply($access_token, $reply_message);
    }

    if ($message == 'PRODUCT') {
        $reply_message = "{
            'messaging_type': 'RESPONSE',
            'recipient':{
              'id': $senderId
            },
            'message':{
              'attachment':{
                'type':'template',
                'payload':{
                  'template_type':'generic',
                  'elements':[
                     {
                      'title':'Classic T-Shirt',
                      'image_url':'https://tse4.mm.bing.net/th?id=OIP.MjqXFMCrbh0NFkVQ7fwm9gHaKl&pid=Api&P=0',
                      'subtitle':'Blue Black RM 149.00',
                      'default_action': {
                        'type': 'web_url',
                        'url': 'https://www.originalcoastclothing.com/',
                        'webview_height_ratio': 'tall',
                      },
                      'buttons':[
                        {
                          'type':'web_url',
                          'url':'https://www.originalcoastclothing.com/',
                          'title':'View Details'
                        },{
                          'type':'postback',
                          'title':'Shop Now',
                          'payload':'size'
                        }              
                      ]      
                    },

                    {
                        'title':'Classic T-Shirt',
                        'image_url':'https://tse4.mm.bing.net/th?id=OIP.RHzRocDQ-VPOif5AmSbAeQHaKl&pid=Api&P=0',
                        'subtitle':'Light grey RM 149.00',
                        'default_action': {
                          'type': 'web_url',
                          'url': 'https://www.originalcoastclothing.com/',
                          'webview_height_ratio': 'tall',
                        },
                        'buttons':[
                          {
                            'type':'web_url',
                            'url':'https://www.originalcoastclothing.com/',
                            'title':'View Details'
                          },{
                            'type':'postback',
                            'title':'Shop Now',
                            'payload':'size'
                          }              
                        ]      
                      },
                  ]
                }
              },
              'quick_replies': [
                {
                    'content_type': 'text',
                    'title': 'Info',
                    'payload': 'product'
                },
                {
                    'content_type': 'text',
                    'title': 'Product',
                    'payload': 'product'
                },
                {
                    'content_type': 'text',
                    'title': 'Receipt',
                    'payload': 'receipt'
                },
                {
                    'content_type': 'text',
                    'title': 'How To Buy',
                    'payload': 'how_to_buy'
                },
            ]
            }
          }";

        sendReply($access_token, $reply_message);
    }

    if ($postback &&  $postback == 'SIZE') {
        $reply_message = "{
            'messaging_type': 'RESPONSE',

            'recipient':{
              'id': $senderId
            },
            
            'message':{
              'text': 'Choose Size :',
              'quick_replies': [
                {
                    'content_type':'text',
                    'title':'S',
                    'payload': 's',
                },
                {
                    'content_type':'text',
                    'title':'M',
                    'payload': 'm',
                },
                {
                    'content_type':'text',
                    'title':'L',
                    'payload': 'l',
                },
                {
                    'content_type':'text',
                    'title':'XL',
                    'payload': 'xl',
                },
              ]
             
            }
          }";

        sendReply($access_token, $reply_message);
    }

    if ($message == 'S' || $message == 'M' || $message == 'L' || $message == 'XL') {
        $reply_message = "{
            'messaging_type': 'RESPONSE',

            'recipient': {
              'id' :  $senderId
            },

            'message': {
              'attachment': {
                'type' : 'template',
                'payload' : {
                  'template_type' : 'button',
                  'text' : 'Confirm Checkout ?',
                  'buttons' : [
                    {
                        'type':'postback',
                        'title':'Confirm',
                        'payload':'confirm'
                    },
                    {
                        'type':'postback',
                        'title':'Cancel',
                        'payload':'cancel'
                    }
                  ]
                }
              }
            }
          }";

        sendReply($access_token, $reply_message);
    }

    if (($message == 'RECEIPT') || ($postback &&  $postback == 'CONFIRM')) {
        $reply_message = "{
            'messaging_type': 'RESPONSE',
            'recipient':{
              'id': $senderId
            },
            'message':{
              'attachment':{
                'type':'template',
                'payload':{
                  'template_type':'receipt',
                  'recipient_name':'Stephane Crozatier',
                  'order_number':'12345678902',
                  'currency':'USD',
                  'payment_method':'Visa 2345',        
                  'order_url':'http://originalcoastclothing.com/order?order_id=123456',
                  'timestamp':'1428444852',         
                  'address':{
                    'street_1':'1 Hacker Way',
                    'street_2': '',
                    'city':'Menlo Park',
                    'postal_code':'94025',
                    'state':'CA',
                    'country':'US'
                  },
                  'summary':{
                    'subtotal':75.00,
                    'shipping_cost':4.95,
                    'total_tax':6.19,
                    'total_cost':56.14
                  },
                  'adjustments':[
                    {
                      'name':'New Customer Discount',
                      'amount':20
                    },
                    {
                      'name':'$10 Off Coupon',
                      'amount':10
                    }
                  ],
                  'elements':[
                    {
                      'title':'Classic White T-Shirt',
                      'subtitle':'100% Soft and Luxurious Cotton',
                      'quantity':2,
                      'price':50,
                      'currency':'USD',
                      'image_url':'https://tse4.mm.bing.net/th?id=OIP.RHzRocDQ-VPOif5AmSbAeQHaKl&pid=Api&P=0'
                    },
                    {
                      'title':'Classic Gray T-Shirt',
                      'subtitle':'100% Soft and Luxurious Cotton',
                      'quantity':1,
                      'price':25,
                      'currency':'USD',
                      'image_url':'https://tse4.mm.bing.net/th?id=OIP.MjqXFMCrbh0NFkVQ7fwm9gHaKl&pid=Api&P=0'
                    }
                  ]
                }
              },
              'quick_replies': [
                {
                    'content_type': 'text',
                    'title': 'Info',
                    'payload': 'product'
                },
                {
                    'content_type': 'text',
                    'title': 'Product',
                    'payload': 'product'
                },
                {
                    'content_type': 'text',
                    'title': 'Receipt',
                    'payload': 'receipt'
                },
                {
                    'content_type': 'text',
                    'title': 'How To Buy',
                    'payload': 'how_to_buy'
                },
            ]
            }
          }";

        sendReply($access_token, $reply_message);
    }
};

function getStarted($access_token = '', $reply = '')
{
    $url = "https://graph.facebook.com/v8.0/me/messenger_profile?access_token=$access_token";
    $ch = curl_init();
    $headers = array('Content-type: application/json');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $reply);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $st = curl_exec($ch);
    $result = json_decode($st, TRUE);

    return $result;
}


function sendReply($access_token = '', $reply = '')
{
    $url = "https://graph.facebook.com/v8.0/me/messages?access_token=$access_token";
    $ch = curl_init();
    $headers = array('Content-type: application/json');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $reply);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $st = curl_exec($ch);
    $result = json_decode($st, TRUE);

    return $result;
}
