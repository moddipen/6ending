<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bet;
use App\Models\Credit;

class MatchEventSettlement extends Model
{
    use HasFactory;
    protected $fillable = [
        'match_event_id',
        'user_id',
        'net_points',
        'points',
        'type'
    ];

    public function event_settlement($type, $bet, $matchevent, $match_event_id){
        if($type == 'credit'){
            //Make user bet as win
            Bet::where("id",$bet['id'])->update(["status"=>"win","type"=>"completed"]);
            
            //Make settlement for won bet  && Net points calculation for winners
            $net_points = $this->net_point_calculation_winner($matchevent['bet_coin'], $matchevent['win_coin'], $bet['bet_coins']);
            MatchEventSettlement::create(["match_event_id"=>$match_event_id, "user_id"=>$bet['user_id'], "net_points"=> $net_points, "type"=>"credit"]);
            
            //Update credit points
            Credit::create([
                "user_id"=>$bet['user_id'], 
                "parent_id"=>$bet['credit']['parent_id'], 
                "points"=> $net_points, 
                "type"=>"bet-credit", 
                "net_points"=>$bet['credit']['net_points'] + $net_points
            ]);
        }else if($type == 'debit'){
            //Make user bet as win
            Bet::where("id",$bet['id'])->update(["status"=>"loss","type"=>"completed"]);
            
            //Make settlement for won bet && Net points calculation for winners
            $net_points = $bet['bet_coins'];
            MatchEventSettlement::create(["match_event_id"=>$match_event_id, "user_id"=>$bet['user_id'], "net_points"=> $net_points, "type"=>"debit"]);
        }else{
            //Make user bet as win
            Bet::where("id",$bet['id'])->update(["status"=>"tie","type"=>"completed"]);

            $net_points = $bet['bet_coins'];
            MatchEventSettlement::create(["match_event_id"=>$match_event_id, "user_id"=>$bet['user_id'], "net_points"=> $net_points, "type"=>"refund"]);
            
            //Update credit points
            Credit::create([
                "user_id"=>$bet['user_id'], 
                "parent_id"=>$bet['credit']['parent_id'], 
                "points"=> $net_points, 
                "type"=>"bet-refund", 
                "net_points"=>$bet['credit']['net_points'] + $net_points
            ]);
        }
    }

    public function net_point_calculation_winner( $actual_bet_coin, $actual_win_coin, $bet_placed_by_user){
        return round($bet_placed_by_user*$actual_win_coin/$actual_bet_coin) + $bet_placed_by_user;
    }
}
