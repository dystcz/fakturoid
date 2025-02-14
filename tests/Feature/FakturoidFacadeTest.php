<?php

use Dystcz\Fakturoid\Contracts\Fakturoid as FakturoidContract;
use Dystcz\Fakturoid\Facades\Fakturoid as FakturoidFacade;
use Dystcz\Fakturoid\Tests\TestCase;

uses(TestCase::class);

it('can call Fakturoid', function (string $method) {
    /** @var TestCase $this */
    $fakturoid = $this->mock(FakturoidContract::class);

    $fakturoid->shouldReceive($method)->once();

    FakturoidFacade::{$method}();
})->with([
    'setAccountSlug',
    'getAuthProvider',
    'getAuthenticationUrl',
    'requestCredentials',
    'getCredentials',
    'setCredentials',
    'setCredentialsCallback',
    'authClientCredentials',
    'getDispatcher',
    'getAccountProvider',
    'getBankAccountsProvider',
    'getEventsProvider',
    'getExpensesProvider',
    'getGeneratorsProvider',
    'getInboxFilesProvider',
    'getInventoryItemsProvider',
    'getInventoryMovesProvider',
    'getInvoicesProvider',
    'getNumberFormatsProvider',
    'getRecurringGeneratorsProvider',
    'getSubjectsProvider',
    'getTodosProvider',
    'getUsersProvider',
    'getWebhooksProvider',
]);
