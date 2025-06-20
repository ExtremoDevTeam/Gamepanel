<?php

/**
 * Created by PhpStorm.
 * User: kiera
 * Date: 28/11/2018
 * Time: 02:50
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

class Config
{
	// Personalisation/Root Options
	public static $name = 'Extremo';
	public static $base_url = "http://localhost:4400/";
	public static $forums_url = "http://localhost:4400/forums/";
	public static $discord_webhook = "";
	public static $enableGamePanel = true;

	public static $discord = [
		"token" => "",
		"guild" => "",
		"icon" => "img/logo-transparent-sm.png"
	];

	// SQL Settings
	// Panel SQL Storage
	public static $sql = [
		'host' => 'panel_database',
		'port' => '3306',
		'user' => 'gamepanel',
		'pass' => 'gamepanel',
		'name' => 'gamepanel'
	];


	// Game SQL Settings
	public static $gameSql = [
		'host' => 'game_database',
		'port' => '3307',
		'user' => 'gamedb',
		'pass' => 'gamedb',
		'name' => 'gamedb'
	];

	// Cache Settings
	public static $cache = [
		'enabled' => true,
		'host' => 'cache',
		'port' => '6379'
	];

	// Staff Teams Settings
	public static $teams = [
		1 => '1',
		2 => '2',
		3 => '3',
		4 => '4',
		5 => '5',
		null => 'Unassigned Members',
		6 => 'Support Team',
		100 => 'SMT',
		500 => 'Development Team',
	];

	// Pusher Config
	public static $pusher = [
		'AUTH_KEY' => '',
        'SECRET' => '',
        'APP_ID' => '',
		'DEFAULT_CONFIG' => [
			'cluster' => 'eu',
			'useTLS' => true
		]
	];

	public static $battleMetrics = [
		'apiKey' => ''
	];

	public static $faction_ranks = [
		'police' => [
			0 => 'Unranked',
			1 => 'Officer',
			2 => 'Senior Officer',
			3 => 'Corporal',
			4 => 'Sergeant',
			5 => 'Lieutenant',
			6 => 'Captain',
			7 => 'Major',
			8 => 'Assistant Chief',
			9 => 'Chief Of Police'
		],
		'medic' => [
			0 => 'Unranked',
			1 => 'Probationary Paramedic',
			2 => 'Advanced EMT',
			3 => 'Paramedic',
			4 => 'EMT',
			5 => 'Advanced Paramedic',
			6 => 'Lieutenant',
			7 => 'Captain',
			8 => 'Medical Advisor',
			9 => 'Deputy Chief Of EMS',
			10 => 'Chief Of EMS'
		]
	];

	// Required! (DO NOT EDIT BELOW THIS LINE)

	// Permissions System
	public static $permissions = [
		//-- Special
		"*",
		"SPECIAL_DEVELOPER",
		"BYPASS_ACTIVITY",

		//-- Cases
		"SUBMIT_CASE",

		//-- General
		"VIEW_GENERAL",
		"VIEW_CASE",
		"VIEW_SLT",

		//-- Staff Management
		"VIEW_USER_INFO",
		"VIEW_USER_ACTIVITY",
		"EDIT_USER_INFO",
		"EDIT_USER_PROMOTION",
		"SEND_USER_ON_LOA",
		"SEND_USER_ON_SUSPENSION",
		"REMOVE_USER",

		//-- Meetings
		"VIEW_MEETING",
		"ADD_MEETING",
		"ADD_MEETING_COMMENT",
		"ADD_MEETING_POINT",
		"REMOVE_MEETING_POINT",

		//-- Interviews
		"VIEW_INTERVIEW",
		"ADD_INTERVIEW",
		"EDIT_INTERVIEW",

		//-- Server Management
		"VIEW_GAME_PLAYER",
		"EDIT_PLAYER_ADMIN",
		"EDIT_PLAYER_POLICE",
		"EDIT_PLAYER_MEDIC",
		"EDIT_PLAYER_BALANCE",

		//-- Punishments
		"ADD_PUNISHMENT",
		"ADD_BAN",
		"ADD_BAN_PERMANENT",

		//-- Guides
		"GUIDE_ADD",
		"GUIDE_EDIT",

		//-- Notebook
		"USE_NOTEBOOK_PAGE",

		//-- Roles
		"ADD_ROLE",
		"EDIT_ROLE",
		"REMOVE_ROLE",

		//-- Ingame Actions
		"IG_KICK_PLAYER",
		"IG_FREEZE_PLAYER_TOGGLE",
		"IG_HEAL_PLAYER",
		"IG_REVIVE_PLAYER",
		"IG_JAIL_PLAYER",
		"IG_UNJAIL_PLAYER",
		"IG_FIX_PLAYER",
		"IG_SPECTATE",
		"IG_ARSENAL",
		"IG_MAP_TELEPORT",
		"IG_MAP_MARKERS",
		"IG_ADMIN_SHOPS"
	];

	public static $permissions_dictionary = [
		//-- Special
		"*" => "Sudo Permission. Allows the staff member to do anything on the panel. (HIGHEST SENSATIVITY PERMISSION)",
		"SPECIAL_DEVELOPER" => "Allows the staff member to view developer pages. (Highly Sensative)",

		//-- Cases
		"SUBMIT_CASE" => "Allows the staff member to add a case in the `Case Log` page.",

		//-- General
		"VIEW_GENERAL" => "Allows the staff member to view general pages.",
		"VIEW_CASE" => "Allows the staff member to view the `Case Log` page.",
		"VIEW_SLT" => "Allows the staff member to view staff management pages.",

		//-- Staff Management
		"VIEW_USER_INFO" => "Allows the staff member to view a user's information on the `Staff Manager` page.",
		"VIEW_USER_ACTIVITY" => "Allows the staff member to view a user's activity on the `Staff Manager` & `Audit Log` page.",
		"EDIT_USER_TEAM" => "Allows the staff member to edit a user's team on the `Staff Manager` page.",
		"EDIT_USER_RANK" => "Allows the staff member to edit a user's rank on the `Staff Manager` page.",
		"EDIT_USER_INFO" => "Allows the staff member to edit a user's info on the `Staff Manager` page.",
		"EDIT_USER_PROMOTION" => "Allows the staff member promote another staff member below them.",
		"SEND_USER_ON_LOA" => "Allows the staff member to send a staff member on LOA.",
		"SEND_USER_ON_SUSPENSION" => "Allows the staff member suspend another staff member.",
		"REMOVE_USER" => "Allows the staff member to remove a member of staff from this panel.",

		//-- Meetings
		"VIEW_MEETING" => "Allows the staff member to view meetings.",
		"ADD_MEETING" => "Allows the staff member to schedule a meeting.",
		"ADD_MEETING_POINT" => "Allows the staff member to open a point in a meeting.",
		"ADD_MEETING_COMMENT" => "Allows the staff member to comment on a meeting.",

		//-- Interviews
		"VIEW_INTERVIEW" => "Allows the staff member to view interviews.",
		"ADD_INTERVIEW" => "Allows the staff member to schedule an interview.",
		"EDIT_INTERVIEW" => "Allows the staff member to edit an interview.",

		//-- Server Management
		"VIEW_GAME_PLAYER" => "Allows the staff member to view & search players.",
		"VIEW_GAME_VEHICLES" => "Allows the staff member to view & search vehicles.",
		"EDIT_PLAYER_ADMIN" => "Allows the staff member to edit a player's admin level.",
		"EDIT_PLAYER_POLICE" => "Allows the staff member to edit a player's police level.",
		"EDIT_PLAYER_MEDIC" => "Allows the staff member to edit a player's medic level.",
		"EDIT_PLAYER_BALANCE" => "Allows the staff member to edit a player's balance.",

		//-- Guides (Staff Policies)
		"GUIDE_ADD" => "Allows the staff member to add a guide to the `Staff Policies` page.",
		"GUIDE_EDIT" => "Allows the staff member to edit a guide on the `Staff Policies` page.",

		//-- Punishments
		"ADD_PUNISHMENT" => "Allows the staff member to issue a punishment of points.",
		"ADD_BAN" => "Allows the staff member to issue a ban through battlemetrics.",
		"ADD_BAN_PERMANENT" => "Allows the staff member to issue permanent ban.",

		//-- Notebook
		"USE_NOTEBOOK_PAGE" => "Allows the staff member to use the notebook feature.",

		//-- Roles
		"ADD_ROLE" => "Allows the staff member to add a role to the `Roles` page.",
		"EDIT_ROLE" => "Allows the staff member to edit a role on the `Roles` page.",
		"REMOVE_ROLE" => "Allows the staff member to remove a role from the `Roles` page.",

		//-- Ingame Actions
		"IG_KICK_PLAYER" => "Kick a player",
		"IG_FREEZE_PLAYER_TOGGLE" => "Freeze a player",
		"IG_HEAL_PLAYER" => "Heal a player",
		"IG_REVIVE_PLAYER" => "Revive a player",
		"IG_JAIL_PLAYER" => "Jail a player",
		"IG_UNJAIL_PLAYER" => "Removes a player from jail",
		"IG_FIX_PLAYER" => "Tries to fix player (Kill a player)",
		"IG_SPECTATE" => "Spectate",
		"IG_ARSENAL" => "Arsenal",
		"IG_MAP_TELEPORT" => "Map teleport",
		"IG_MAP_MARKERS" => "Map markers",
		"IG_ADMIN_SHOPS" => "Admin shops"
	];
}
