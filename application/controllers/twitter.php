<?php
/**
 * Twitter OAuth library.
 * Sample controller.
 * Requirements: enabled Session library, enabled URL helper
 * Please note that this sample controller is just an example of how you can use the library.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Twitter extends CI_Controller
{
	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
	
	/**
	 * Controller constructor
	 */
	function __construct()
	{
		parent::__construct();
		// Loading TwitterOauth library. Delete this line if you choose autoload method.
		$this->load->library('twitteroauth');
		// Loading twitter configuration.
		$this->config->load('twitter');
		// Loading session library to access the session
 		$this->load->library('session');
 		// Loading url helper library to use base_url and redirect function
 		$this->load->helper('url');

		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			// If user already logged in
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('access_token'),  $this->session->userdata('access_token_secret'));
		}
		elseif($this->session->userdata('request_token') && $this->session->userdata('request_token_secret'))
		{
			// If user in process of authentication
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
		}
		else
		{
			// Unknown user
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
		}
	}
	
	public function index()
	{
		$data['title'] = "Twitter Followers";
		$data['heading'] = "Who's following whom?";
		$data['authenticated'] = false;

		if ($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			$data['authenticated'] = true;
		}
		$data['screen_name'] = $this->session->userdata('twitter_screen_name');
		$this->load->view('twitterview', $data);

		$reauthenticate = $this->input->post('reauthenticate');
 		$unauthenticate = $this->input->post('unauthenticate');

 		if ($unauthenticate)
 		{
 			$this->unauthenticate();
 		}
 		elseif ($reauthenticate)
 		{
 			$this->reauthenticate();
 		}
	}

	/**
	* Gets list of ids of twitter users that the logged in user is following
	* @access  public
	* @return  void
	*/
	public function get_friends()
	{
		$friends = $this->connection->get('friends/list', array("count" => "200"));
		print json_encode($friends);
	}

	/**
	* Gets logged in user's timeline of tweets
	* @access  public
	* @return  void
	*/
	public function get_timeline()
	{
		$timeline = $this->connection->get("statuses/home_timeline", array("count" => "200"));
		print json_encode($timeline);
	}

	/**
	* Reset Session and remove twitter credentials
	* @access  public
	* @return  void
	*/
	public function unauthenticate()
	{
		$this->reset_session();
		redirect(base_url('/'));
	}

	/**
	 * Manually kick off a reauthentication process
	 * @access public
	 * @return void
	 */
	public function reauthenticate()
	{
		$this->reset_session();
		redirect(base_url('/index.php/twitter/auth'));
	}

	/**
	 * Begin Authentication Process
	 * @access	public
	 * @return	void
	 */
	public function auth()
	{

		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			// User is already authenticated. Add your user notification code here.
			redirect(base_url('/'));
		}
		else
		{
			// Making a request for request_token
			$request_token = $this->connection->getRequestToken(base_url('/index.php/twitter/callback'));
			$this->session->set_userdata('request_token', $request_token['oauth_token']);
			$this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
			
			if($this->connection->http_code == 200)
			{
				$url = $this->connection->getAuthorizeURL($request_token);
				redirect($url);
			}
			else
			{
				// An error occured. Make sure to put your error notification code here.
				redirect(base_url('/'));
			}
		}
	}
	
	/**
	 * Callback function, landing page for twitter.
	 * @access	public
	 * @return	void
	 */
	public function callback()
	{
		if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token'))
		{
			$this->reset_session();
			redirect(base_url('/index.php/twitter/auth'));
		}
		else
		{
			$access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));
		
			if ($this->connection->http_code == 200)
			{
				$this->session->set_userdata('access_token', $access_token['oauth_token']);
				$this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
				$this->session->set_userdata('twitter_user_id', $access_token['user_id']);
				$this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);

				$this->session->unset_userdata('request_token');
				$this->session->unset_userdata('request_token_secret');
				
				redirect(base_url('/'));
			}
			else
			{
				// An error occured. Add your notification code here.
				redirect(base_url('/'));
			}
		}
	}
	
	/**
	 * Reset session data
	 * @access	private
	 * @return	void
	 */
	private function reset_session()
	{
		$this->session->unset_userdata('access_token');
		$this->session->unset_userdata('access_token_secret');
		$this->session->unset_userdata('request_token');
		$this->session->unset_userdata('request_token_secret');
		$this->session->unset_userdata('twitter_user_id');
		$this->session->unset_userdata('twitter_screen_name');
	}
}

/* End of file twitter.php */
/* Location: ./application/controllers/twitter.php */