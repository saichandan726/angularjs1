<?php

class BillingController extends BaseController
 {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{	
			$company_id = Auth::user()->userCompany->company_id;	

		try{
			$customer = Braintree_Customer::find($company_id);
			}
			catch (Braintree_Exception_NotFound $e) {
			$customer='';
			}
		$services = HubbService::all();
		$subscriptionHistory = $serviceSubsription = $serviceActivePlan = $planDiscount = '';

		
		foreach ($services as $service) {
			$companySubscription = $service->Subscriptions()->Company()->first();			
			$serviceSubsription[$service->id] = $companySubscription;	
			if($companySubscription)		
			{
				$serviceActivePlan[$service->id] = $companySubscription->service->servicePlans()->Active()->first();			
				$planDiscount[$service->id] = HubbPromo::where('plan_id',$serviceActivePlan[$service->id]['id'])->first();
				$subscriptionHistory[$service->id] =  SubscriptionHistory::where('subscription_id',$serviceSubsription[$service->id]['id'])->companys()->get()->take(3);
			}		

		}
	
		$hubbService = HubbService:: where('service_code','PTM')->first(); 
        $subscription = CompanySubscription::where('company_id',$company_id)->where('hubbServiceID',$hubbService->id)->first(); 	
	   
	    $company_subscription_id = $subscription->id;
	    $unused_keys = UserSubscriptionKeys::where('company_subscription_id',$company_subscription_id)->whereNull('user_id')->count();	
	    $servicePalns = $subscription->service->servicePlans()->Active()->first();    
	    //$plans = Braintree_Plan::all();         	

        return View::make('billing.index')->with(array(        	
        	'history'		   		 => $subscriptionHistory,
        	'services'		   		 => $services,  
        	'ActivePlan'		   	 => $serviceActivePlan, 
        	'free_subscription_keys' => $unused_keys,	        
	        'company_subscription'   => $subscription,
	        'customer'               => $customer,	       
	        'serviceSubsription'     => $serviceSubsription,	       
	        'servicePlans'           => $servicePalns,		       
	        'discount'				 => $planDiscount
	       ));
	}

	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('billing.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$expiration_month = Input::get('expiration_month');		
		$expiration_year = Input::get('expiration_year');	
		$expiration_date = $expiration_month.'/'.$expiration_year;
		
		$result = Braintree_Customer::create(array(
			'id' => Auth::user()->userCompany->company_id,
			'firstName' => Input::get('first_name'),
  			'lastName' => Input::get('last_name'),
  			'company' => Auth::user()->userCompany->name,
  			'email'   => Auth::user()->email,
  			'phone'   => Input::get('phone'),  			  			
		    'creditCard' => array(
		    'cardholderName' => Input::get('cardholderName'),
		    'number' => Input::get('card_number'),
		    'cvv' => Input::get('cvv'),
		    'expirationDate' => $expiration_date,
		     'options' => array(			            
			            'verifyCard' => true
			        ),
		    'billingAddress' => array(
			  'firstName' => Input::get('first_name'),
	  		  'lastName' => Input::get('last_name'),
	  		  'company' => Auth::user()->userCompany->name,
		      'streetAddress' => Input::get('street_address'),
		      'extendedAddress' => Input::get('extended_address'),
		      'locality' => Input::get('locality'),
		      'region' => Input::get('region'),
		      'postalCode' => Input::get('postal_code'),
		      'countryCodeAlpha2' => Input::get('country')
		    )
		  )
		  )
		);	

		if($result->success)						
		  return  Response::json(array('isSuccessful' => true));	
		else
		{
			$message="<p>The following errors have occurred:</p><ul>";
			foreach($result->errors->deepAll() AS $error) {
   				$message.="<li>". $error->message."</li>" ;	}
   				$message.="</ul>";
   				return  Response::json(array('isSuccessful' => false,'error' => $message));   			
		}
		
	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
        return View::make('billing.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
  		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$expiration_month = Input::get('expiration_month');
		$expiration_year = Input::get('expiration_year');
		$expiration_date = $expiration_month.'/'.$expiration_year;
		

			$result = Braintree_Customer::update(
			Auth::user()->userCompany->company_id,
			array(
			'firstName' => Input::get('first_name'),
  			'lastName' => Input::get('last_name'),		
  			'phone'   => Input::get('phone'),
			    'creditCard' => array(
			    'cardholderName' => Input::get('cardholderName'),
			    'number' => Input::get('card_number'),			   
			    'expirationDate' => $expiration_date,
			     'options' => array(
			            'updateExistingToken' => Input::get('creditcard_token'),
			            'verifyCard' => true
			        ),
				    'billingAddress' => array(
					  'firstName' => Input::get('billing_fname'),
			  		  'lastName' => Input::get('billing_lname'),
			  		  'company' => Auth::user()->userCompany->company->name,
				      'streetAddress' => Input::get('street_address'),
				      'extendedAddress' => Input::get('extended_address'),
				      'locality' => Input::get('locality'),
				      'region' => Input::get('region'),
				      'postalCode' => Input::get('postal_code'),
				      'countryCodeAlpha2' => Input::get('country'),
				      'options' => array(
			                'updateExisting' => true
			            )
				    )
			  )
		  )
		);			
		if($result->success)	
		  return  Response::json(array('isSuccessful' => true));	
		else
		{
			$message="<p>The following errors have occurred:</p><ul>";
			foreach($result->errors->deepAll() AS $error) {
   				$message.="<li>". $error->message."</li>" ;	}
   				$message.="</ul>";
   			return  Response::json(array('isSuccessful' => false,'error' => $message)); 			
		}
		
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
