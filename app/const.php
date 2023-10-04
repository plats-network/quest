<?php

if (!defined('DEFINE_CONSTANT')) {
    define('DEFINE_CONSTANT', 'DEFINE_CONSTANT');
    define('DASHBOARD_WEB_ROUTER', 'cws.home');
    //USER_COMPLETED_TASK
    define('USER_COMPLETED_TASK', 1);
    //USER_PROCESSING_TASK
    define('USER_PROCESSING_TASK', 0);

    // Zero
    define('ZERO', 0);

    define('CHECKIN', 0);
    define('EVENT', 1);

    define('TASK_SESSION', 0);
    define('TASK_BOOTH', 1);

    define('PAGE_SIZE', 20);
    define('INPUT_MAX_LENGTH', 255);
    define('CONFIRM', 1);
    /**
     * User
     */
    define('USER_ROLE', 1);
    define('ADMIN_ROLE', 2);
    define('CLIENT_ROLE', 3);
    define('GUEST_ROLE', 4);

    define('USER_ACTIVE', 1);
    define('USER_CONFIRM', 2);
    define('USER_DELETED', 99);

    // Task LIKE, PIN
    define('TASK_LIKE', 0);
    define('TASK_PIN', 1);

    /**
     * Tasks
     */
    define('INACTIVE_TASK', 0);
    define('ACTIVE_TASK', 1);
    define('TYPE_FREE_TASK', 1);

    //User-Tasks-Status
    define('USER_TASK_DOING', 0);
    define('USER_TASK_DONE', 1);
    define('USER_TASK_CANCEL', 2);
    define('USER_TASK_TIMEOUT', 3);

    /**
     * Tasks Location
     */
    define('INACTIVE_LOCATION_TASK', 0);
    define('ACTIVE_LOCATION_TASK', 1);

    /**
     * Withdraw status
     */
    define('WITHDRAWN_STATUS_PENDING', 0);
    define('WITHDRAWN_STATUS_PROCESSING', 1);
    define('WITHDRAWN_STATUS_COMPLETED', 2);

    /**
     * Tasks order
     */
    define('OUT_OF_ORDER', 0);
    define('IN_ORDER', 1);

    /**
     * Tasks type
     */
    define('TYPE_CHECKIN', 1);
    define('TYPE_INSTALL_APP', 2);
    define('TYPE_VIDEO_WATCH', 3);
    define('TYPE_SOCIAL', 4);

    /**
     * Tasks status
     */
    define('TASK_DRAFT', 0);
    define('TASK_PUBLIC', 1);
    /**
     * Tasks checkin type
     */
    define('ONE_OF_MANY_LOCATIONS', 1);
    define('MULTIPLE_LOCATIONS', 2);

    /**
     * User Reward Type
     */
    define('REWARD_TOKEN', 0);
    define('REWARD_NFT', 1);
    define('REWARD_VOUCHER', 2);
    define('REWARD_BOX', 3);
    define('REWARD_WALLET', 4);

    // TWITTER
    define('TWITTER_LIMIT', 100);

    /**
     * Tasks type platform
     */
    define('TWITTER', 1);
    define('FACEBOOK', 2);
    define('DISCORD', 3);
    define('TELEGRAM', 4);
    define('GOOGLE', 5);

    // Twitter
    define('TWITTER_FOLLOW', 0);
    define('TWITTER_LIKE', 1);
    define('TWITTER_RETWEET', 2);
    define('TWITTER_TWEET', 3);

    // Facebook
    define('FACEBOOK_SHARE', 0);
    define('FACEBOOK_LIKE', 1);
    define('FACEBOOK_POST', 2);
    define('FACEBOOK_JOIN_GROUP', 3);

    // Telegram
    define('TELEGRAM_JOIN', 0);

    // Discord
    define('DISCORD_JOIN', 0);

    /**
     * Tasks type action
     */
    define('FOLLOW', 1);
    define('LIKE', 2);
    define('SHARE', 3);
    define('RETWEET', 4);
    define('TWEET', 5);
    define('POST', 6);
    define('JOIN_GROUP', 7);
    define('HASHTAG', 8);

    /**
     * Error code
     */
    define('CREDENTIALS_NOT_MATCH', 2);
    define('RESET_CODE_INVALID', 3);
    define('CONFIRM_CODE_INVALID', 4);
    define('EMAIL_UNVERIFIED', 5);
    define('TIME_INVALID', 6);
    define('ACCOUNT_ACTIVED', 7);
    define('REQUIRE_LOGIN_SOCIAL', 8);
    define('VALIDATE_FAILED', 9);
    define('MODEL_NOT_FOUND', 10);
    define('UNAUTHENTICATED_OR_TOKEN_EXPIRED', 11);
    define('QUERY_EXCEPTION', 12);
    define('INTERNAL_ERROR', 13);
    define('LOGIN_FACEBOOK_ERROR', 14);
    define('LOGIN_GOOGLE_ERROR', 15);
    define('LOGIN_APPLE_ERROR', 16);
    define('LOGIN_SOCIAL_ERROR', 17);

    define('CONFIRM_HASH', 50);
    define('CONFIRM_HOUR', 48);
}
