<?php
namespace Ctrl;


class TfTask implements \Tf\Task\TaskIf{

    public function postBidding(\Tf\Task\BiddingSt $bidding_st){
        $Mdl = new \Mdl\TfTask();
        return $Mdl->postBidding($bidding_st);
    }

    public function supplementBidding(\Tf\Task\BiddingSt $bidding_st){
        $Mdl = new \Mdl\TfTask();
        $Mdl->supplementBidding($bidding_st);
    }

    public function bidding($id){
        $Mdl = new \Mdl\TfTask();
        return $Mdl->bidding($id);
    }

    public function biddingList(\Tf\Task\BiddingListPSt $bidding_list_pst){
        $Mdl = new \Mdl\TfTask();
        return $Mdl->biddingList($bidding_list_pst);
    }

    public function biddingFinished($id){

    }

    public function postBid(\Tf\Task\BidSt $bid_st){
        $Mdl = new \Mdl\TfTask();
        return $Mdl->postBid($bid_st);
    }

    public function supplementBid(\Tf\Task\BidSt $bid_st){
        $Mdl = new \Mdl\TfTask();
        $Mdl->supplementBid($bid_st);
    }

    public function bidList(\Tf\Task\BidListPSt $bid_list_pst){
        $Mdl = new \Mdl\TfTask();
        return $Mdl->bidList($bid_list_pst);
    }

    public function bidFinishedList(\Tf\Task\BidListPSt $bid_list_pst){

    }

} 