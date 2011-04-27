<?php
/** 
 * Copyright (c) 2011, Cédric DERUE
 * All rights reserved.
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the University of California, Berkeley nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS ``AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE REGENTS AND CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * Script d'initialisation de la base de données zendcrm
 */

try {
	// Crée une nouvelle connexion à MongoDB
	$connexion = new Mongo(); // connexion
	// Sélectionne la base de données zendcrm
	$db = $connexion->zendcrm;
	
	// Réinitialise la base de données 
	$db->drop();
	
	// Crée un administrateur
	$admin = array(
		'firstname' 		=> 'Admin',
		'lastname' 			=> 'Admin',
		'email'					=> 'admin@zendcrm.com',
		'login' 				=> 'admin',
		'password_hash' => md5('admin'),
		'role' 					=> 'ADM',
		'is_active' 		=> true,
		'creator' 			=> 'admin' 
	);
	
	// Sauvegarde l'administrateur
	$db->users->insert($admin);
	//$admin = $db->users->findOne(array('login' => 'admin'));
	//$adminRef = $db->users->createDBRef($admin);
	
	// Crée un utilisateur normal
	$user = array(
		'firstname' 		=> 'Cédric',
		'lastname' 			=> 'Dérue',
		'email' 				=> 'cedric.derue@zendcrm.com',
		'login' 				=> 'cderue',
		'password_hash' => md5('cderue'),
		'role' 					=> 'STD',
		'is_active' 		=> true,
		'creator' 			=> 'admin'
	);
	
	// Sauvegarde l'utilisateur normal
	$db->users->insert($user);
	//$user = $db->users->findOne(array('login' => 'cderue'));
	//$userRef = $db->users->createDBRef($user);
	
	// Crée un compte client
	$account = array(
		'name' => 'IT Services',
		'phone_office' => '0318678900',
		'phone_fax' => '0318678901',
		'address' => array(
			'city' => 'Lyon',
			'country' => 'France'
		),
		'creator' => 'cderue'
	);
	
	// Sauvegarde le compte client
	$db->accounts->insert($account);
	$account = $db->accounts->findOne(array('name' => 'IT Services'));
	$accountRef = $db->accounts->createDBRef($account);
	
	
	// Crée un premier prospect
	$leadOne = array(
		'firstname' 	=> 'Caroline',
		'lastname' 		=> 'Durdan',
		'email' 			=> 'caroline.durdan@pharmacie-gv.com',
		'account' 		=> 'Pharmacie du Grand Vallon',
		'phone_office' => '0418228990',
		'status' 			=> '1',
		'creator' 		=> 'cderue'
	);
	
	// Crée un autre prospect
	$leadOther = array(
		'firstname' 	 => 'Edouard',
		'lastname' 		 => 'Parège',
		'email' 			 => 'edouard.parege@itservices.com',
		'account'			 => 'IT Services',
		'phone_office' => '0116278001',
		'status' 			 => '1',
		'creator' 		 => 'cderue'
	);
	
	// Sauvegarde les deux prospects
	$db->leads->insert($leadOne);
	$db->leads->insert($leadOther);
	
	// Crée un contact
	$contact = array(
		'firstname' 	 => 'Bernard',
		'lastname' 		 => 'Conte',
		'account'			 => $accountRef,
		'job_title' 	 => 'Directeur',
		'email' 			 => 'bernard.conte@itservices.com',
		'phone_office' => '0116278004',
		'creator' 		 => 'cderue'
	);
	
	// Sauvegarde le contact
	$db->contacts->insert($contact);
	
	//$db->contacts->update(array('lastname' => 'Conte'), array('$push' => array('account' => $accountRef)));
	$contact = $db->contacts->findOne(array('lastname' => 'Conte'));
	$contactRef = $db->contacts->createDBRef($contact);
	
	// Crée une opportunité
	$opportunity = array(
		'name' => 'Sport & Co Intranet',
		'account' => $accountRef,
		'amount' => 200000,
		'date_closed' => '28/11/2011',
		'contact' => $contactRef,
		'creator' => 'cderue'
	);
	
	// Sauvegarde l'opportunité
	$db->opportunities->insert($opportunity);
	//$opportunity = $db->opportunities->findOne(array('name' => 'Sport & Co Intranet'));
	//$db->opportunities->update(array('name' => 'Sport & Co Intranet'), array('$push' => array('account' => $accountRef)));
	//$db->opportunities->update(array('name' => 'Sport & Co Intranet'), array('$push' => array('contact' => $contactRef)));
	
	echo 'Database created successfully';
} catch (\Exception $ex) {
	die('Database error: ' . $ex);
}