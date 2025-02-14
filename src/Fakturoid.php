<?php

namespace Dystcz\Fakturoid;

use BadMethodCallException;
use Dystcz\Fakturoid\Contracts\Fakturoid as FakturoidContract;
use Fakturoid\Exception\AuthorizationFailedException;
use Fakturoid\FakturoidManager;

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
    /**
     * @throws AuthorizationFailedException
     */
    public function __construct(protected FakturoidManager $fakturoid)
    {
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
