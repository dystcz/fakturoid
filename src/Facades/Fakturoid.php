<?php

namespace Dystcz\Fakturoid\Facades;

use Illuminate\Support\Facades\Facade as LaravelFacade;

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
class Fakturoid extends LaravelFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-fakturoid';
    }
}
