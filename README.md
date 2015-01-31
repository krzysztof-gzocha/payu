# PayU Integration
This library written in PHP will allow easily integration with [PayU API v2.1](http://developers.payu.com/pl/restapi.html).  
Works with PHP version >=5.4 and HHVM.  
[![Build Status](https://travis-ci.org/krzysztof-gzocha/payu.svg?branch=master)](https://travis-ci.org/krzysztof-gzocha/payu)
### Installation by composer
---
To install this library simply add requirement to composer.  
You can do this by 
```
php /path/to/composer.phar require "krzysztof-gzocha/payu:dev-master"
```  
or simply add this to composer.json:
```json
{
    "require": {
        "krzysztof-gzocha/payu": "dev-master"
    }
}
```  
and run 
```
composer install
```

### Basic usage
---
#### 1. Configuration 
Default configuration's object is ```\Team3\PayU\Configuration\Configuration```, but any object that implements ```\Team3\PayU\Configuration\ConfigurationInterface``` will do the job. Most of the configuration parameters are already defined, you only have to set credentials (merchant ID and private key) taken from PayU. Test account credentials are already defined in ```\Team3\PayU\Configuration\Credentials\TestCredentials```, so if you just want to test the appllication you can use this class.

Configuration with test credentials:
```php
use Team3\PayU\Configuration\Configuration;
use Team3\PayU\Configuration\Credentials\TestCredentials;

$payuConfiguration = new Configuration(
    new TestCredentials()
);
```
Configuration with real credentials:
```php
use Team3\PayU\Configuration\Configuration;
use Team3\PayU\Configuration\Credentials\Credentials;

$payuConfiguration = new Configuration(
    new Credentials('<merchant pos id>', '<private key>')
);
```
#### 2. Create basic order object
Please remember that orders created by those examples are not configured enough. Some required parameters like OpenPayU-Signature, totalAmount, customerIp, etc are still missing. You can add them automatically, but it will be described in another chapter. Both examples are describing the most basic configuration. Order created by both examples are equal.
##### 2.1 Using order object from library
Order object in this library is by default represented by ```\Team3\PayU\Order\Model\Order```, but anything that implements ```\Team3\PayU\Order\Model\OrderInterface``` will work.
This chapter is about creating this object, but if you are integrating this library with currently working application you can do this work automatically with annotations described in chapter below.

Example order with single product:
```php
use \Team3\PayU\Order\Model\Order;
use \Team3\PayU\Order\Model\Products\Product;
use \Team3\PayU\Order\Model\Money\Money;

$order = new Order();
$product = new Product();

$order
    ->setDescription('Example order')
    ->setCurrencyCode('EUR')
    ->setOrderId('123456');

$product
    ->setName('Some product')
    ->setQuantity(10)
    ->setUnitPrice(new Money(10));

$order->getProductCollection()->addProduct($product);
```

##### 2.2 Using annotations
You don't need to create another order object if you already have one in your application.
You will just have to put single annotation ```\Team3\PayU\Annotation\PayU``` on *methods* that returns useful parameters.
Lets say you have your own order class called ```\Users\App\UserOrder``` and product class called ```\Users\App\UserProduct```. Annotation can be set on public, protected or private methods. You can add annotation in presented way: 
```php
namespace Users\App;

use Team3\PayU\Annotation\PayU;
use Team3\PayU\Order\Model\Money\Money;

class UserOrder
{
	/**
	* @PayU(propertyName="general.orderId")
	*/
	public function getId()
	{
		return '123456';
	}

	/**
	* @PayU(propertyName="general.description")
	*/
	private function getDescription()
	{
		return 'Example order';
	}

	/**
	* @PayU(propertyName="general.currencyCode")
	*/
	private function getCurrencyCode()
	{
		return 'EUR';
	}

	/**
	* @PayU(propertyName="productCollection")
	*/
	private function getProducts()
	{
		// Both array and \Traversable object can be returned
		return [
			new UserProduct(),
		];
	}
}

class UserProduct
{
	/**
	* @PayU(propertyName="product.name")
	*/
	private function getName()
	{
		return 'Some product';
	}

	/**
	* @PayU(propertyName="product.quantity")
	*/
	private function getQuantity()
	{
		return 10;
	}
	
	/**
	* @PayU(propertyName="product.unitPrice")
	*/
	private function getPrice()
	{
		// This method should return anything
		// that implements \Team3\PayU\Order\Model\Money\MoneyInterface
		return new Money(10);
	} 
}
```
All property names can be found at ```\Team3\PayU\Order\Transformer\UserOrder\TransformerProperties```.
It's worth to mention that one of the annotation is especially useful in complicated architecture. It's called ```follow``` annotation. If you have to collect required parameters from different, connected entities you can use this annotation. Result of this method will be passed through this transformer again.

Now to create order object you have to use UserOrderTransfomer, which will literally transform your's object for library purposes. 
To do so you can use this example:
```php
use \Team3\PayU\Order\Transformer\UserOrder\UserOrderTransformerFactory;

$order = new Order(); // Order for library purposes
$userOrder = new UserOrder(); // Order from users application

$logger = new NullLogger(); // ONLY for example. Use real logger.
$transformerFactory = new UserOrderTransformerFactory();
$transformer = $transformerFactory->build($logger);

// Will transform UserOrder into Order
$transformer->transform($order, $userOrder);

// $order->getDescription() => 'Example order'
```
#### 3. Order parameters auto-completion
You are not left alone when it comes to fulfill other required parameters like signature.
To do so you can use this code:
```php
use \Team3\PayU\NullLogger;
use \Team3\PayU\Order\Autocomplete\OrderAutocompleteFactory;

$logger = new NullLogger(); // ONLY for example. Use real logger.
$autocompleteFactory = new OrderAutocompleteFactory();
$autocomplete = $autocompleteFactory->build($logger);

// Complete $order with parameters. Use $credentials
try {
	$autocomplete->autocomplete($order, $credentials);
} catch (OrderAutocompleteException $exception) {
	// Something went wrong.
}

// $order->getSignature() => '7f46165474d11ee5836777d85df2cdab';
```
#### 4. Inform PayU about new order
To inform PayU about our new order you have to send OrderCreateRequest with correctly build object, check HTTP status code of the response, deserialize the response to OrderCreateResponse object, check if request status is ```SUCCESS``` and redirect user to given URL.  Here is an example how to use RequestProcess:
```php
use \Symfony\Component\Validator\ConstraintViolationListInterface;
use \Team3\PayU\Communication\Process\RequestProcessFactory;
use \Team3\PayU\Communication\Request\OrderCreateRequest;
use \Team3\PayU\Communication\Response\OrderCreateResponse;
use \Team3\PayU\NullLogger;

$logger = new NullLogger(); // ONLY for example. Use real logger.
$requestProcessFactory = new RequestProcessFactory();
$requestProcess = $requestProcessFactory->build($logger);

try {
	/** @var OrderCreateResponse $orderCreateResponse **/
	$orderCreateResponse = $requestProcess->process(
	    new OrderCreateRequest($order),
	    $configuration
	);
} catch (InvalidRequestDataObjectException $exception) {
	/** 
	* $order is invalid. Violations are stored in exception.
	* @var ConstraintViolationListInterface $violations 
	*/
	$violations = $exception->getViolations();
} catch (PayUException $exception) {
	// something went wrong.
}

if ($orderCreateResponse->getRequestStatus()->isSuccess()) {
	// Request was ok. You can redirect user to given url 
	$this->redirectTo(
		$orderCreateResponse->getRedirectUri()
	);
} else {
	// Request was not ok. 
	// Pass this information to user however you want
}
```
#### 5. Retrieve order from PayU
Retrieving info is similar process to creating new order. You can use the same RequestProcess, but with different Request object. Example:
```php
// $requestProcess was created in exactly the same way.
use \Team3\PayU\Communication\Response\OrderRetrieveResponse;

$order->setPayUOrderId('<order id from payu>');
$requestProcess->shouldValidate(false); // We dont need to validate this time

try {
	/** @var OrderRetrieveResponse $orderStatusResponse */
	$orderStatusResponse = $requestProcess->process(
		new OrderRetrieveRequest($order), // $order->getPayU
		$configuration
	);
} catch (PayUException $exception) {
	// Something went wrong..
}

// Order status:
// $status = $orderStatusResponse->getFirstOrder()->getStatus();
// Completed status:
// $status->isCompleted() -> true


```

#### 6. Process notification about order
PayU can inform you about any changes in your order. To use this mechanism you simply need to define ```$order->setNotifyUrl('<URL in your app>')```. PayU will send notification directly to this URL.
In action defined in notify URL you have to parse JSON string of the notification and check for the order status.
To do so you can use NotificationProcess.
```php
use \Team3\PayU\Communication\Process\NotificationProcess\NotificationProcessFactory;
use \Team3\PayU\Communication\Notification\OrderNotification;
use \Team3\PayU\Communication\Process\NotificationProcess\NotificationProcessException;

$logger = new NullLogger(); // Only for example. 
$notificationProcessFactory = new NotificationProcessFactory();
$notificationProcess = $notificationProcessFactory->build($logger);

// $notificationData is content of received notification  
// $signatureHeader can be read from http header "OpenPayu-Signature"  
// from received notification. It can be null.  

try {
	/** @var OrderNotification $orderNotification */
	$orderNotification = $notificationProcess->process(
		$configuration->getCredentials(),
		$notificationData,
		$signatureHeader
	);
} catch (NotificationProcessException $exception) {
	// Something was wrong with the process. Maybe signature was wrong?
} catch (PayUException $exception) {
	// Something went really wrong..
}

// $orderNotification->getOrder()->getStatus->isCompleted() -> true
```

## Important
Please note that PayU will send notification in asynchronous way, so when you will receive notification about completing or cancelling order then you should ignore all later notifications.
