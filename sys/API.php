<?php
@ini_set('memory_limit', '-1');
ignore_user_abort(true);
set_time_limit(0);
header('Content-type: application/json');
$result = array('result' => 'failed');
include_once(__DIR__ . '/functions.php');
startSession();

if (isset($_SESSION['__l0gg3d_us3r__'])) {
	if (isset($_GET['action'])) {
		$action = $_GET['action'];
		$logged_user_id = intval($_SESSION['__l0gg3d_us3r__']);

		switch ($action) {
			case 'create_test':
				if (isset($_GET['package_id'])) {
					$package_id = intval($_GET['package_id']);
					$logged_user = getLoggedUser();

					if ($logged_user) {
						if (!isAdmin($logged_user) && ($logged_user['credits'] < getServerProperty('test_min_credits', 0))) {
							header('location: ../clients.php?result=no_min_credits');
							exit();
						}

						if (createFastTest($logged_user_id, $package_id)) {
							header('location: ../clients.php?result=test_created');
							exit();
						}
					}

					header('location: ../clients.php?result=test_not_created');
					exit();
				}

				break;
			case 'get_online_clients':
				if (isset($_GET['start']) && isset($_GET['length']) && isset($_GET['search']) && isset($_GET['order'])) {
					$start = intval($_GET['start']);
					$length = intval($_GET['length']);
					$search = (isset($_GET['search']['value']) ? $_GET['search']['value'] : '');
					$order_column_index = (isset($_GET['order'][0]['column']) ? intval($_GET['order'][0]['column']) : 0);
					$order_type = (isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'desc');
					$draw = (isset($_GET['draw']) ? intval($_GET['draw']) : 1);
					$result = getAllOnlineClientsTable($logged_user_id, $start, $length, $search, $order_column_index, $order_type);
					$result['draw'] = $draw;
				}

				break;
			case 'get_clients':
				if (isset($_GET['start']) && isset($_GET['length']) && isset($_GET['search']) && isset($_GET['order'])) {
					$start = intval($_GET['start']);
					$length = intval($_GET['length']);
					$search = (isset($_GET['search']['value']) ? $_GET['search']['value'] : '');
					$order_column_index = (isset($_GET['order'][0]['column']) ? intval($_GET['order'][0]['column']) : 0);
					$order_type = (isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'desc');
					$draw = (isset($_GET['draw']) ? intval($_GET['draw']) : 1);
					$result = getAllClientsTable($logged_user_id, $start, $length, $search, $order_column_index, $order_type);
					$result['draw'] = $draw;
				}

				break;
			case 'get_resellers':
				if (isset($_GET['start']) && isset($_GET['length']) && isset($_GET['search']) && isset($_GET['order'])) {
					$start = intval($_GET['start']);
					$length = intval($_GET['length']);
					$search = (isset($_GET['search']['value']) ? $_GET['search']['value'] : '');
					$order_column_index = (isset($_GET['order'][0]['column']) ? intval($_GET['order'][0]['column']) : 0);
					$order_type = (isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'desc');
					$draw = (isset($_GET['draw']) ? intval($_GET['draw']) : 1);
					$result = getAllResellersTable($logged_user_id, $start, $length, $search, $order_column_index, $order_type);
					$result['draw'] = $draw;
				}

				break;
			case 'get_tickets':
				if (isset($_GET['start']) && isset($_GET['length']) && isset($_GET['search']) && isset($_GET['order'])) {
					$start = intval($_GET['start']);
					$length = intval($_GET['length']);
					$search = (isset($_GET['search']['value']) ? $_GET['search']['value'] : '');
					$order_column_index = (isset($_GET['order'][0]['column']) ? intval($_GET['order'][0]['column']) : 0);
					$order_type = (isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'desc');
					$draw = (isset($_GET['draw']) ? intval($_GET['draw']) : 1);
					$result = getTickets($logged_user_id, $start, $length, $search, $order_column_index, $order_type);
					$result['draw'] = $draw;
				}

				break;
			case 'renew_client':
				if (isset($_GET['client_id'])) {
					$client_id = intval($_GET['client_id']);
					$client = getClientByID($client_id);

					if ($client) {
						$logged_user = getLoggedUser();

						if ($logged_user) {
							$credits = $client['max_connections'] * 1;

							if (hasPermission($logged_user_id, $client['id'])) {
								if (addOrRemoveCredits($logged_user_id, -$credits)) {
									if (renewClient($client['id'], 1)) {
										$old_credits = $logged_user['credits'];
										$logged_user = getLoggedUser();
										$now_credits = $logged_user['credits'];
										insertRegUserLog($logged_user['id'], $client['username'], $client['password'], '[<b>UserPanel</b> -> <u>Extend Line</u>] with Package [Custom Package], Credits: <font color="green">' . $old_credits . '</font> -> <font color="red">' . $now_credits . '</font>');
										$result['result'] = 'success';
									}
								}
							}
						}
					}
				}

				break;
			case 'renew_client_plus':
				if (isset($_GET['client_id']) && isset($_GET['months'])) {
					$months = intval($_GET['months']);

					if (0 < $months) {
						$client_id = intval($_GET['client_id']);
						$client = getClientByID($client_id);

						if ($client) {
							$logged_user = getLoggedUser();

							if ($logged_user) {
								$credits = $client['max_connections'] * 1 * $months;

								if (hasPermission($logged_user_id, $client['id'])) {
									if (addOrRemoveCredits($logged_user_id, -$credits)) {
										if (renewClient($client['id'], $months)) {
											$old_credits = $logged_user['credits'];
											$logged_user = getLoggedUser();
											$now_credits = $logged_user['credits'];
											insertRegUserLog($logged_user['id'], $client['username'], $client['password'], '[<b>UserPanel</b> -> <u>Extend Line</u>] with Package [Custom Package], Credits: <font color="green">' . $old_credits . '</font> -> <font color="red">' . $now_credits . '</font>');
											$result['result'] = 'success';
										}
									}
								}
							}
						}
					}
				}

				break;
			case 'add_screen':
				if (isset($_GET['client_id'])) {
					$client_id = intval($_GET['client_id']);
					$logged_user = getLoggedUser();

					if ($logged_user) {
						if (hasPermission($logged_user_id, $client_id)) {
							if (addOrRemoveCredits($logged_user_id, -1)) {
								if (addScreenClient($client_id, 1)) {
									$result['result'] = 'success';
								}
							}
						}
					}
				}

				break;
			case 'change_credits':
				if (isset($_GET['reseller_id']) && isset($_GET['credits'])) {
					$reseller_id = intval($_GET['reseller_id']);
					$credits = intval($_GET['credits']);
					$logged_user = getLoggedUser();

					if ($logged_user) {
						if (masterHasPermission($logged_user_id, $reseller_id)) {
							if (transferCredits($logged_user_id, $reseller_id, $credits)) {
								$result['result'] = 'success';
							}
						}
					}
				}

				break;
			case 'toggle_block_client':
				if (isset($_GET['user_id'])) {
					$user_id = intval($_GET['user_id']);

					if (hasPermission($logged_user_id, $user_id)) {
						if (toggleClientBlock($user_id)) {
							$result['result'] = 'success';
						}
					}
				}

				break;
			case 'toggle_block_reseller':
				if (isset($_GET['reseller_id'])) {
					$reseller_id = intval($_GET['reseller_id']);

					if (masterHasPermission($logged_user_id, $reseller_id)) {
						if (toggleBlock($reseller_id)) {
							$result['result'] = 'success';
						}
					}
				}

				break;
			case 'delete_client':
				if (isset($_GET['user_id'])) {
					$user_id = intval($_GET['user_id']);

					if (hasPermission($logged_user_id, $user_id)) {
						$client = getClientByID($user_id);

						if ($client) {
							if (deleteClient($user_id)) {
								insertRegUserLog($logged_user_id, $client['username'], $client['password'], '[<b>UserPanel</b> -> <u>Delete Line</u>]');
								$result['result'] = 'success';
							}
						}
					}
				}

				break;
			case 'delete_reseller':
				if (isset($_GET['reseller_id'])) {
					$reseller_id = intval($_GET['reseller_id']);

					if (masterHasPermission($logged_user_id, $reseller_id)) {
						if (deleteReseller($reseller_id)) {
							$result['result'] = 'success';
						}
					}
				}

				break;
			case 'toggle_ticket':
				if (isset($_GET['ticket_id'])) {
					$ticket_id = intval($_GET['ticket_id']);
					$ticket = getTicketById($ticket_id);
					$logged_user = getLoggedUser();
					if ($ticket && $logged_user) {
						if (($ticket['member_id'] === $logged_user['id']) || isAdmin($logged_user)) {
							if (toggleTicket($ticket_id)) {
								$result['result'] = 'success';
							}
						}
					}
				}

				break;
			case 'delete_ticket':
				if (isset($_GET['ticket_id'])) {
					$ticket_id = intval($_GET['ticket_id']);
					$logged_user = getLoggedUser();

					if ($logged_user) {
						if (isAdmin($logged_user)) {
							if (deleteTicket($ticket_id)) {
								$result['result'] = 'success';
							}
						}
					}
				}

				break;
			case 'get_streams':
				break;
			case 'create_update_list':
				break;
		}
	}
}

echo json_encode($result);
