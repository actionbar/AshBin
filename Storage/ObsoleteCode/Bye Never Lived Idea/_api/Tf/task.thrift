// include "c.thrift"

namespace php Tf.Task
namespace js Tf.Task



const map<string,string> SSO_COOKIE_NAME = {
    'sessId':'sso_sess_id',
    'signInfo':'sso_sign_info'
}


struct CoordSt {
    1: required double lat,
    2: required double lon
}


/**
 * Error Id Enum
 */
enum ErrIdEnum {
    //SUCCESS = 0,
    // unknown error
    ERR_UNKNOWN = 1,
// system or server maintenance
    ERR_SERVER = 2,

// db not exists or page not found
    ERR_NOT_EXISTS = 3,
// db value exits, cant create one more
    ERR_REPEATED = 4,
// user send illegal words or something illegal
    ERR_USER_INPUT = 5,
// temporary verification
    ERR_CAPTCHA = 6,
// username or pwd error, or verify code error
    ERR_VERIFY = 7,
// need login, or permissions neccesarry
    ERR_PERMISSION = 8
}


exception Err {
    1: ErrIdEnum id,
    2: string msg
}

enum TransactionEnum {
    // cheap and easy, take few time
    CHORES = 1,
    // both bidder and biddee pay security (5% - 10%), the breaching party shall pay to the other party a fine.
    SECURITY = 2,
    BOND = 3,
    FREE_MARKET = 4
}

enum BiddingSortEnum {
    NONE = 0
}



enum PrivacyEnum{
    LOWEST = 1,
    LOWER = 2,
    LOW = 3,
    MIDLOW = 4,
    MIDDLE = 5,
    MIDHIGH = 6,
    HIGH = 7,
    HIGHER = 8,
    HIGHEST = 9 
}

struct BiddingSt {
    16: optional i64 id,
    1: optional string biddee,
    2: required TransactionEnum transaction,
    3: required BiddingSortEnum sorts,
    4: required i64 unit_price,
    5: required byte shares = 1,
    6: required i64 bond = 0,
    7: required i64 winners = 0,
    8: required i64 bidders = 0,
    9: required string title,
    10: required string keywords,
    11: required string description,
    12: required string text,
    13: required i64 time_now,
    14: required i64 deadline,
    15: required byte state,
    80: optional double lon = 0,
    81: optional double lat = 0,
    99: optional PrivacyEnum privacy
}

struct BiddingListSt {
    1: optional string biddee
}

enum BiddingOrderEnum {
    NONE = 0,
    PRICE = 1,
    PRICE_DESC = 2,
    SHARES =3,
    SHARES_DESC = 4,
    DEADLINE = 5,
    DEADLINE_DESC = 6,
    BIDDERS = 7,
    BIDDERS_DESC = 8,
    WINNDERS = 9,
    WINNDERS_DESC =10,
    DISTANCE = 11
}

struct PriceRangeSt {
    1: optional i64 min,
    2: optional i64 max
}

struct BiddingListPSt {
    1: optional string biddee,
    2: optional TransactionEnum transaction,
    3: optional BiddingOrderEnum order,
    4: optional PriceRangeSt price,
}

struct BidSt {
    10: optional i64 id,
    1: optional i64 bidding_id,
    2: optional string bidder,
    3: optional i32 quotation,
    4: optional i32 bid_security,
    5: required i64 delivery_time,
    6: required string text,
    7: required i64 time_now,
    8: optional byte state,
    80: optional double lon,
    81: optional double lat,
    99: optional PrivacyEnum privacy
}

enum BidOrderEnum {
    DEFAUT = 0,
    TIME = 1,
    TIME_DESC = 2,
    BID_SECURITY = 3,
    DELIVER_TIME = 4,
    DELIVER_TIME_DESC = 5
    // 距离
    DISTANCE = 6
}

struct BidListPSt {
    2: required i64 bidding_id,
    3: optional i32 id_offset,
    4: optional BidOrderEnum order
}

service Task {
    i64 postBidding(1: BiddingSt bidding_st) throws (1:Err err),
    void supplementBidding(1: BiddingSt bidding_st) throws (1:Err err),
    BiddingSt bidding(1: i64 id) throws (1:Err err),
    list<BiddingSt> biddingList(1: BiddingListPSt bidding_list_pst) throws (1:Err err),
    BiddingSt biddingFinished(1: i64 id) throws (1:Err err),
    i64 postBid(1: BidSt bid_st) throws (1:Err err),
    void supplementBid(1: BidSt bid_st) throws (1:Err err),
    list<BidSt> bidList(1: BidListPSt bid_list_pst) throws (1:Err err),
    list<BidSt> bidFinishedList(1: BidListPSt bid_list_pst) throws (1:Err err)
}