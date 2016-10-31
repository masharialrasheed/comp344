<?php
	require_once 'database.php';

	function store_session_open($save_path, $sess_name) {
		$store_session_con = getDatabaseConnection();
		return TRUE;
	}

	function store_session_close() {
		$store_session_con = null;
    return TRUE;
	}

	function store_session_read($session_id) {
    $params = [$session_id];
		$rows = query("SELECT data FROM Session WHERE id = ?", $params);

		if (count($rows)) {
			return $rows[0]['data'];
		}
		return '';
	}

	function store_session_write($session_id, $session_data){
    $p = [$session_id];
	  $exists = count(query("SELECT COUNT(*) as count FROM Session WHERE id = ?", $p));
    $params = [$session_id, $session_data];

		if ($exists) {
      query("UPDATE Session SET id = ?, data = ?", $params);
    } else {
      query("REPLACE Session (id, data) VALUES (?,?)", $params);
    }
    return TRUE;
	}

	function store_session_destroy($session_id){
    $params = [$session_id];
		query("DELETE FROM Session WHERE id = ?", $params);
    return TRUE;
	}

	function store_session_gc($gc_maxlife){
		$params = [$gc_maxlife];
		query("DELETE FROM Session WHERE `time` < NOW() - INTERVAL ? SECOND", $params);
		return TRUE;
	}

	ini_set("session.save_handler", "user");

	session_set_save_handler(
		"store_session_open",
		"store_session_close",
		"store_session_read",
		"store_session_write",
		"store_session_destroy",
		"store_session_gc"
	);

	session_start();
?>
