@extends('layouts.app')

@section('body')
    <div class="leaderboard">
        <div id="outerContainer">
            <div id="contentContainer">
                <div id="content">
                    <h1>World Leaderboards</h1>
                    <div class="leaderboard-table" style="position: relative; z-index:2;">
                        <table style="position:relative;z-index:2;margin:0 auto;" cellspacing="0" cellpadding="2">
                            <thead>
                                <tr>
                                    <th class="division">
                                        &nbsp;&nbsp;Division&nbsp;&nbsp;<br>Rank </th>
                                    <th class="player">
                                        &nbsp;&nbsp;Player</th>
                                    <th class="rating">
                                        &nbsp;&nbsp;Rating</th>
                                    </th>
                                    <th class="bracket">
                                        &nbsp;&nbsp;Bracket</th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="leaderboard_body">
                                @foreach ($players as $player)
                                    <tr class="player_info">
                                        <td class="player_rank">{{ $loop->iteration }}</td>
                                        <td>&nbsp;&nbsp;{{ isset($player->team->tag) ? $player->team->tag . '.' : '' }}<span
                                                class="player_name">{{ $player->username }}</span>
                                        </td>
                                        <td class="player_rating">{{ $player->rating }}</td>
                                        <td class="player_bracket">{{ $player->bracket->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="bottomContainer_1">
            <div id="bottomContainer_2">

            </div>
        </div>
    </div>
@endsection
