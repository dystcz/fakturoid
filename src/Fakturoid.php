<?php

namespace Dystcz\Fakturoid;

use BadMethodCallException;
use Dystcz\Fakturoid\Contracts\Fakturoid as FakturoidContract;
use Fakturoid\Exception\AuthorizationFailedException;
use Fakturoid\FakturoidManager;
use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * @method void setAccountSlug(string $companySlug)
 * @method \Fakturoid\Auth\AuthProvider getAuthProvider()
 * @method string getAuthenticationUrl()
 * @method void requestCredentials(string $code)
 * @method \Fakturoid\Auth\Credentials|null getCredentials()
 * @method void setCredentials(\Fakturoid\Auth\Credentials $credentials)
 * @method void setCredentialsCallback(\Fakturoid\Auth\CredentialCallback $callback)
 * @method void authClientCredentials()
 * @method \Fakturoid\Dispatcher getDispatcher()
 * @method \Fakturoid\Provider\AccountProvider getAccountProvider()
 * @method \Fakturoid\Provider\BankAccountsProvider getBankAccountsProvider()
 * @method \Fakturoid\Provider\EventsProvider getEventsProvider()
 * @method \Fakturoid\Provider\ExpensesProvider getExpensesProvider()
 * @method \Fakturoid\Provider\GeneratorsProvider getGeneratorsProvider()
 * @method \Fakturoid\Provider\InboxFilesProvider getInboxFilesProvider()
 * @method \Fakturoid\Provider\InventoryItemsProvider getInventoryItemsProvider()
 * @method \Fakturoid\Provider\InventoryMovesProvider getInventoryMovesProvider()
 * @method \Fakturoid\Provider\InvoicesProvider getInvoicesProvider()
 * @method \Fakturoid\Provider\NumberFormatsProvider getNumberFormatsProvider()
 * @method \Fakturoid\Provider\RecurringGeneratorsProvider getRecurringGeneratorsProvider()
 * @method \Fakturoid\Provider\SubjectsProvider getSubjectsProvider()
 * @method \Fakturoid\Provider\TodosProvider getTodosProvider()
 * @method \Fakturoid\Provider\UsersProvider getUsersProvider()
 * @method \Fakturoid\Provider\WebhooksProvider getWebhooksProvider()
 *
 * @see \Fakturoid\FakturoidManager
 */
class Fakturoid implements FakturoidContract
{
    protected FakturoidManager $fakturoid;

    /**
     * @throws AuthorizationFailedException
     */
    public function __construct()
    {
        $this->fakturoid = App::make(FakturoidManager::class, [
            'client' => new Guzzle,
            'clientId' => Config::get('fakturoid.client_id'),
            'clientSecret' => Config::get('fakturoid.client_secret'),
            'userAgent' => Config::get('fakturoid.user_agent'),
            'accountSlug' => Config::get('fakturoid.account_slug'),
        ]);

        $this->fakturoid->authClientCredentials();
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return $this->{$method}(...$arguments);
        }

        if (method_exists($this->fakturoid, $method)) {
            return $this->fakturoid->{$method}(...$arguments);
        }

        throw new BadMethodCallException("Method '{$method}' does not exist on Fakturoid manager.");
    }
}
