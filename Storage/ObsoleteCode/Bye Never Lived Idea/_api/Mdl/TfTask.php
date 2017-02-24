<?php
namespace Mdl;


class TfTask{
    public static $signInfo;

    public function setSignInfo(){
        self::$signInfo = ['username'=>'云上旭'];
    }

    public function getSignInfoUsername(){
        if(empty(self::$signInfo)){
            $this->setSignInfo();
        }
        return self::$signInfo['username'];
    }

    public function postBidding(\Tf\Task\BiddingSt $BiddingSt){
        $TaskBidding = new \Mdl\Dal\Task\Bidding();
        $TaskBidding->biddee = $this->getSignInfoUsername();
        $TaskBidding->timeNow = $_SERVER['REQUEST_TIME'];

        $TaskBidding->transaction = $BiddingSt->transaction;
        $TaskBidding->sorts = $BiddingSt->sorts;
        $TaskBidding->unitPrice = $BiddingSt->unit_price;
        $TaskBidding->shares = $BiddingSt->shares;
        $TaskBidding->bond = $BiddingSt->bond;
        $TaskBidding->winners = $BiddingSt->winners;
        $TaskBidding->bidders = $BiddingSt->bidders;
        $TaskBidding->title = $BiddingSt->title;
        $TaskBidding->keywords = $BiddingSt->keywords;
        $TaskBidding->description = $BiddingSt->description;
        $TaskBidding->text = $BiddingSt->text;
        $TaskBidding->deadline = $BiddingSt->deadline;
        $TaskBidding->state = $BiddingSt->state;
        $TaskBidding->lon = $BiddingSt->lon;
        $TaskBidding->lat = $BiddingSt->lat;
        $TaskBidding->privacy = $BiddingSt->privacy;

        $Qs = $TaskBidding->insert();
        $MySqli = new \Mdl\Conf\MySqli();
        $id = $MySqli->writeTask()->execId($Qs);
        if(empty($id)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_SERVER;
            $Err->msg = '数据写入不正确';
            throw $Err;
        }
        return $id;
    }

    public function supplementBidding(\Tf\Task\BiddingSt $BiddingSt){
        $TaskBidding = new \Mdl\Dal\Task\Bidding();
        $TaskBidding->biddee = $this->getSignInfoUsername();
        $TaskBidding->id = $BiddingSt->id;
        $TaskBidding->text = $BiddingSt->text;
        $Qs = $TaskBidding->supplement();
        $MySqli = new \Mdl\Conf\MySqli();
        if(empty($MySqli->writeTask()->exec($Qs))){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_SERVER;
            $Err->msg = '追加数据不正确';
            throw $Err;
        }
    }

    public function bidding($id){
        $TaskBidding = new \Mdl\Dal\Task\Bidding();
        $TaskBidding->id = $id;
        $Qs = $TaskBidding->queryOne();
        $MySqli = new \Mdl\Conf\MySqli();
        $Qa = $MySqli->readTask()->queryOne($Qs);
        if(!$Qa){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_NOT_EXISTS;
            $Err->msg = '查询的数据不存在';
            throw $Err;
        }

        $BiddingSt = new \Tf\Task\BiddingSt();
        $BiddingSt->biddee = $Qa[$TaskBidding::BIDDEE];
        $BiddingSt->transaction = $Qa[$TaskBidding::TRANSACTION];
        $BiddingSt->sorts = $Qa[$TaskBidding::SORTS];
        $BiddingSt->unit_price = $Qa[$TaskBidding::UNIT_PRICE];
        $BiddingSt->shares = $Qa[$TaskBidding::SHARES];
        $BiddingSt->bond = $Qa[$TaskBidding::BOND];
        $BiddingSt->winners = $Qa[$TaskBidding::WINNERS];
        $BiddingSt->bidders = $Qa[$TaskBidding::BIDDERS];
        $BiddingSt->title = $Qa[$TaskBidding::TITLE];
        $BiddingSt->keywords = $Qa[$TaskBidding::KEYWORDS];
        $BiddingSt->description = $Qa[$TaskBidding::DESCRIPTION];
        $BiddingSt->text = $Qa[$TaskBidding::TEXT];
        $BiddingSt->time_now = $Qa[$TaskBidding::TIME_NOW];
        $BiddingSt->deadline = $Qa[$TaskBidding::DEADLINE];
        $BiddingSt->state = $Qa[$TaskBidding::STATE];
        $BiddingSt->lon = $Qa[$TaskBidding::LON];
        $BiddingSt->lat = $Qa[$TaskBidding::LAT];
        $BiddingSt->privacy = $Qa[$TaskBidding::PRIVACY];
        return $BiddingSt;
    }

    public function biddingList(\Tf\Task\BiddingListPSt $bidding_list_pst){
        $TaskBidding = new \Mdl\Dal\Task\Bidding();
        $TaskBidding->biddee = $bidding_list_pst->biddee;
        $TaskBidding->transaction = $bidding_list_pst->transaction;
        $Qs = $TaskBidding->query();

        $MySqli = new \Mdl\Conf\MySqli();
        $Qq = $MySqli->readTask()->query($Qs);
        if(!$Qq){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_NOT_EXISTS;
            $Err->msg = '查询的数据不存在';
            throw $Err;
        }
        $rtn = array();
        foreach($Qq as $Qa){
            $BiddingSt = new \Tf\Task\BiddingSt();
            $BiddingSt->biddee = $Qa[$TaskBidding::BIDDEE];
            $BiddingSt->transaction = $Qa[$TaskBidding::TRANSACTION];
            $BiddingSt->sorts = $Qa[$TaskBidding::SORTS];
            $BiddingSt->unit_price = $Qa[$TaskBidding::UNIT_PRICE];
            $BiddingSt->shares = $Qa[$TaskBidding::SHARES];
            $BiddingSt->bond = $Qa[$TaskBidding::BOND];
            $BiddingSt->winners = $Qa[$TaskBidding::WINNERS];
            $BiddingSt->bidders = $Qa[$TaskBidding::BIDDERS];
            $BiddingSt->title = $Qa[$TaskBidding::TITLE];
            $BiddingSt->keywords = $Qa[$TaskBidding::KEYWORDS];
            $BiddingSt->description = $Qa[$TaskBidding::DESCRIPTION];
            $BiddingSt->text = $Qa[$TaskBidding::TEXT];
            $BiddingSt->time_now = $Qa[$TaskBidding::TIME_NOW];
            $BiddingSt->deadline = $Qa[$TaskBidding::DEADLINE];
            $BiddingSt->state = $Qa[$TaskBidding::STATE];
            $BiddingSt->lon = $Qa[$TaskBidding::LON];
            $BiddingSt->lat = $Qa[$TaskBidding::LAT];
            $rtn[] = $BiddingSt;
        }

        return $rtn;
    }

    public function postBid(\Tf\Task\BidSt $bid_st){
        $TaskBid = new \Mdl\Dal\Task\Bid();
        $TaskBid->timeNow = $_SERVER['REQUEST_TIME'];

        $TaskBid->biddingId = $bid_st->bidding_id;
        $TaskBid->bidder = $bid_st->bidder;
        $TaskBid->privacy = $bid_st->privacy;
        $TaskBid->bidSecurity = $bid_st->bid_security;
        $TaskBid->deliveryTime = $bid_st->delivery_time;
        $TaskBid->lat = $bid_st->lat;
        $TaskBid->lon = $bid_st->lon;
        $TaskBid->quotation = $bid_st->quotation;
        $TaskBid->text = $bid_st->text;
        $Qs = $TaskBid->insert();
        $MySqli = new \Mdl\Conf\MySqli();
        $id = $MySqli->readTask()->execId($Qs);
        if(empty($id)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_SERVER;
            $Err->msg = '数据写入不正确';
            throw $Err;
        }
        return $id;

    }

    /*
     * 一个人只能在一个bidding id 下，竞标一次，所以采用 bidding_id + bidder 定位竞标，而不是bid_id
     * */

    public function supplementBid(\Tf\Task\BidSt $bid_st){
        $TaskBid = new \Mdl\Dal\Task\Bid();
        $TaskBid->bidder = $this->getSignInfoUsername();

        $TaskBid->biddingId = $bid_st->bidding_id;
        $TaskBid->text = $bid_st->text;
        $Qs = $TaskBid->supplement();

        $MySqli = new \Mdl\Conf\MySqli();
        if(empty($MySqli->writeTask()->exec($Qs))){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_SERVER;
            $Err->msg = '追加数据不正确';
            throw $Err;
        }
    }


    public function bidList(\Tf\Task\BidListPSt $bid_list_pst){
        $TaskBid = new \Mdl\Dal\Task\Bid();
        $TaskBid->biddingId = $bid_list_pst->bidding_id;
        $Qs = $TaskBid->query();
        $MySqli = new \Mdl\Conf\MySqli();
        $Qq = $MySqli->readTask()->query($Qs);
        if(!$Qq){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_NOT_EXISTS;
            $Err->msg = '查询的数据不存在';
            throw $Err;
        }
        $rtn = array();
        foreach($Qq as $Qa){
            $BidSt = new \Tf\Task\BidSt();
            $BidSt->bidder = $Qa[$TaskBid::BIDDER];
            $BidSt->quotation = $Qa[$TaskBid::QUOTATION];
            $BidSt->bid_security = $Qa[$TaskBid::BID_SECURITY];
            $BidSt->delivery_time = $Qa[$TaskBid::DELIVERY_TIME];
            $BidSt->text = $Qa[$TaskBid::TEXT];
            $BidSt->time_now = $Qa[$TaskBid::TIME_NOW];
            $BidSt->state = $Qa[$TaskBid::STATE];
            $BidSt->lon = $Qa[$TaskBid::LON];
            $BidSt->lat= $Qa[$TaskBid::LAT];
            $rtn[] = $BidSt;
        }

        return $rtn;

    }

}