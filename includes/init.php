<?php
/**
 * The file that defines the initial plugin functions
 *
 * A hooks definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://addonify.com/
 * @since      1.0.0
 *
 * @package    Udp_agent
 */

global $this_agent_ver, $engine_url;

// -------------------------------------------
// Config
// -------------------------------------------

$engine_url     = 'http://localhost:10003/';
$this_agent_ver = '1.0.0';

// -------------------------------------------
// Which agent to load ?
// -------------------------------------------
$root_dir             = dirname( __DIR__, 1 );
$all_installed_agents = get_option( 'udp_installed_agents', array() );
$this_agent_is_latest = true;

// make sure this agent is the latest.
foreach ( $all_installed_agents as $agent_ver ) {
	if ( version_compare( $agent_ver, $this_agent_ver ) > 0 ) {
		$this_agent_is_latest = false;
		break;
	}
}

// load this agent, only if it is the latest version and this agent is installed.
if ( $this_agent_is_latest && isset( $all_installed_agents[ basename( $root_dir ) ] ) ) {
	if ( ! class_exists( 'Udp_Agent' ) ) {
		require_once __DIR__ . '/class-udp-agent.php';
	}
	new Udp_Agent( $this_agent_ver, $root_dir, $engine_url );
}

// -------------------------------------------
// Agent Activation
// -------------------------------------------

// for plugin.
register_activation_hook(
	$root_dir . DIRECTORY_SEPARATOR . basename( $root_dir ) . '.php',
	function() {
		global $this_agent_ver, $engine_url;

		$root_dir = dirname( __DIR__, 1 );

		// authorize this agent with engine.
		if ( ! class_exists( 'Udp_Agent' ) ) {
			require_once __DIR__ . '/class-udp-agent.php';
		}
		$agent = new Udp_Agent( $this_agent_ver, $root_dir, $engine_url );
		$agent->do_handshake();

		$installed_agents                          = get_option( 'udp_installed_agents', array() );
		$installed_agents[ basename( $root_dir ) ] = $this_agent_ver;

		// register this agent locally.
		update_option( 'udp_installed_agents', $installed_agents );

		// show admin notice if user selected "no" but new agent is installed.
		$show_admin_notice = get_option( 'udp_agent_allow_tracking' );
		if ( 'no' === $show_admin_notice ) {
			$active_agent = get_option( 'udp_active_agent_basename' );
			if ( basename( $root_dir ) !== $active_agent ) {
				update_option( 'udp_active_agent_basename', basename( $root_dir ) );
				delete_option( 'udp_agent_allow_tracking' );
			}
		}
	}
);

// for theme.
add_action(
	'after_switch_theme',
	function() {
		global $this_agent_ver, $engine_url;

		$root_dir = dirname( __DIR__, 1 );

		// authorize this agent with engine.
		if ( ! class_exists( 'Udp_Agent' ) ) {
			require_once __DIR__ . '/class-udp-agent.php';
		}
		$agent = new Udp_Agent( $this_agent_ver, $root_dir, $engine_url );
		$agent->do_handshake();

		$installed_agents                          = get_option( 'udp_installed_agents', array() );
		$installed_agents[ basename( $root_dir ) ] = $this_agent_ver;

		// register this agent locally.
		update_option( 'udp_installed_agents', $installed_agents );

		// show admin notice if user selected "no" but new agent is installed.
		$show_admin_notice = get_option( 'udp_agent_allow_tracking' );
		if ( 'no' === $show_admin_notice ) {
			$active_agent = get_option( 'udp_active_agent_basename' );
			if ( basename( $root_dir ) !== $active_agent ) {
				update_option( 'udp_active_agent_basename', basename( $root_dir ) );
				delete_option( 'udp_agent_allow_tracking' );
			}
		}
	}
);

// -------------------------------------------
// Agent De-activation
// -------------------------------------------

// for plugin.
register_deactivation_hook(
	$root_dir . DIRECTORY_SEPARATOR . basename( $root_dir ) . '.php',
	function () {

		$root_dir = dirname( __DIR__, 1 );

		$installed_agents = get_option( 'udp_installed_agents', array() );
		if ( isset( $installed_agents[ basename( $root_dir ) ] ) ) {
			unset( $installed_agents[ basename( $root_dir ) ] );
		}

		// remove this agent from the list of active agents.
		update_option( 'udp_installed_agents', $installed_agents );
		$timestamp = wp_next_scheduled( 'udp_agent_cron' );
		wp_unschedule_event( $timestamp, 'udp_agent_cron' );
	}
);

// for theme.
add_action(
	'switch_theme',
	function () {

		$root_dir = dirname( __DIR__, 1 );

		$installed_agents = get_option( 'udp_installed_agents', array() );
		if ( isset( $installed_agents[ basename( $root_dir ) ] ) ) {
			unset( $installed_agents[ basename( $root_dir ) ] );
		}

		// remove this agent from the list of active agents.
		update_option( 'udp_installed_agents', $installed_agents );
	}
);
