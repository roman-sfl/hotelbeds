<?php namespace StayForLong\HotelBeds\Contracts;


interface PaymentDataInterface {
	public function setCardType($a_card_type);
	public function setCardNumber($a_card_number);
	public function setHolderCardName($a_holder_card_name);
	public function setExpirationDate($a_expiration_date);
	public function setCardCVC($a_card_cvc);
	public function setEmail($an_contact_email);
	public function setPhoneNumber($a_contact_phone);
	public function getPaymentCard();
	public function getContactData();
}