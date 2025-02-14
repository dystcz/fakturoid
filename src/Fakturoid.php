<?php

namespace Dystcz\Fakturoid;

use BadMethodCallException;
use Fakturoid\Exception\AuthorizationFailedException;
use Fakturoid\FakturoidManager;
use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\Facades\Config;

/**
 * @method static void setAccountSlug(string $companySlug)
 * @method static \Fakturoid\Auth\AuthProvider getAuthProvider()
 * @method static string getAuthenticationUrl()
 * @method static void requestCredentials(string $code)
 * @method static \Fakturoid\Auth\Credentials|null getCredentials()
 * @method static void setCredentials(\Fakturoid\Auth\Credentials $credentials)
 * @method static void setCredentialsCallback(\Fakturoid\Auth\CredentialCallback $callback)
 * @method static void authClientCredentials()
 * @method static \Fakturoid\Dispatcher getDispatcher()
 * @method static \Fakturoid\Provider\AccountProvider getAccountProvider()
 * @method static \Fakturoid\Provider\BankAccountsProvider getBankAccountsProvider()
 * @method static \Fakturoid\Provider\EventsProvider getEventsProvider()
 * @method static \Fakturoid\Provider\ExpensesProvider getExpensesProvider()
 * @method static \Fakturoid\Provider\GeneratorsProvider getGeneratorsProvider()
 * @method static \Fakturoid\Provider\InboxFilesProvider getInboxFilesProvider()
 * @method static \Fakturoid\Provider\InventoryItemsProvider getInventoryItemsProvider()
 * @method static \Fakturoid\Provider\InventoryMovesProvider getInventoryMovesProvider()
 * @method static \Fakturoid\Provider\InvoicesProvider getInvoicesProvider()
 * @method static \Fakturoid\Provider\NumberFormatsProvider getNumberFormatsProvider()
 * @method static \Fakturoid\Provider\RecurringGeneratorsProvider getRecurringGeneratorsProvider()
 * @method static \Fakturoid\Provider\SubjectsProvider getSubjectsProvider()
 * @method static \Fakturoid\Provider\TodosProvider getTodosProvider()
 * @method static \Fakturoid\Provider\UsersProvider getUsersProvider()
 * @method static \Fakturoid\Provider\WebhooksProvider getWebhooksProvider()
 *
 * @see \Fakturoid\FakturoidManager
 */
class Fakturoid
{
    protected FakturoidManager $fakturoid;

    /**
     * @throws AuthorizationFailedException
     */
    public function __construct()
    {
        $this->fakturoid = new FakturoidManager(
            client: new Guzzle,
            clientId: Config::get('fakturoid.account_api_id'),
            clientSecret: Config::get('fakturoid.account_api_secret'),
            userAgent: Config::get('fakturoid.user_agent'),
            accountSlug: Config::get('fakturoid.account_slug'),
        );

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
