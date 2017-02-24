<?php
namespace Mdl\Dal\Task;


class Bid {
    const ID = 'i';
    const BIDDING_ID = 'biddingid';
    const BIDDER = 'bidder';
    const QUOTATION = 'quotation';
    const BID_SECURITY = 'bidsecurity';
    const DELIVERY_TIME = 'deliverytime';
    const STATE = 'state';
    const TEXT = 'f';
    const PRIVACY = 'privacy';
    const TIME_NOW = 't';
    const LON = 'lon';
    const LAT = 'lat';

    public $id;
    public $biddingId;
    public $bidder;
    public $quotation;
    public $bidSecurity;
    public $deliveryTime;
    public $state;
    public $text;
    public $timeNow;
    public $privacy;
    public $lon;
    public $lat;


    public function insert(){
        return 'INSERT INTO task_bid SET
         biddingid='. $this->biddingId .',
         bidder="'. $this->bidder .'",
         quotation = '. $this->quotation .',
         bidsecurity = '. $this->bidSecurity .',
         deliverytime = '. $this->deliveryTime .',
         state = 0,
         f="'. $this->text .'",
         t='.$this->timeNow .',
         privacy='.$this->privacy .',
         lon='. $this->lon .',
         lat='. $this->lat;
    }

    //文章一旦发布不可以修改，但是可以添加新内容，添加新内容自动追在文章尾部，原内容不可以编辑，用<div class="task-add"><h2>修改说明小标题<em>2014-20-23 22:33:20</em></h2>说明的内容，可能包括图片、html标签</div>
    public function supplement(){
        return 'UPDATE task_bid SET
        f=concat(f, "' . $this->text . '")
        WHERE
         biddingid=' . $this->biddingId . '
        AND
         bidder = "' . $this->bidder . '"';
    }


    public function query(){
        return 'SELECT * FROM task_bid WHERE biddingid='. $this->biddingId. ' ORDER BY t DESC LIMIT 20';
    }



} 