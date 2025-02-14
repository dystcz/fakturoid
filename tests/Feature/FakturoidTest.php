<?php

use Dystcz\Fakturoid\Contracts\Fakturoid as FakturoidContract;
use Dystcz\Fakturoid\Facades\Fakturoid as FakturoidFacade;
use Dystcz\Fakturoid\Fakturoid;
use Dystcz\Fakturoid\Tests\TestCase;
use Fakturoid\Auth\CredentialCallback;
use Fakturoid\Auth\Credentials;
use Fakturoid\Dispatcher;
use Fakturoid\Enum\AuthTypeEnum;
use Fakturoid\FakturoidManager;
use Fakturoid\Provider\AccountProvider;

uses(TestCase::class);

it('forwards calls to FakturoidManager', function (string $method, array $params = []) {
    /** @var TestCase $this */
    // $dispatcher = Mockery::mock(Dispatcher::class);
    //
    // $accountProvider = Mockery::mock(new AccountProvider($dispatcher));

    $fakturoidManager = Mockery::mock(FakturoidManager::class);

    $this->app->instance('fakturoid', $fakturoidManager);

    $fakturoid = Mockery::mock(Fakturoid::class, FakturoidContract::class);

    $fakturoidManager->shouldReceive('authClientCredentials')->once();
    $fakturoidManager->shouldReceive($method)->once()->with(...$params);

    FakturoidFacade::{$method}(...$params);
})->with([
    ['setAccountSlug', ['test']],
    ['getAuthProvider'],
    ['getAuthenticationUrl'],
    ['requestCredentials', ['code']],
    ['getCredentials'],
    ['setCredentials', [new Credentials(
        'refresh_token',
        'access_token',
        DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, '2021-01-01T00:00:00+00:00'),
        AuthTypeEnum::AUTHORIZATION_CODE_FLOW
    )]],
    ['setCredentialsCallback', [
        new class implements CredentialCallback
        {
            public function __invoke(?Credentials $credentials = null): void {}
        },
    ]],
    ['authClientCredentials'],
    ['getDispatcher'],
    ['getAccountProvider'],
    ['getBankAccountsProvider'],
    ['getEventsProvider'],
    ['getExpensesProvider'],
    ['getGeneratorsProvider'],
    ['getInboxFilesProvider'],
    ['getInventoryItemsProvider'],
    ['getInventoryMovesProvider'],
    ['getInvoicesProvider'],
    ['getNumberFormatsProvider'],
    ['getRecurringGeneratorsProvider'],
    ['getSubjectsProvider'],
    ['getTodosProvider'],
    ['getUsersProvider'],
    ['getWebhooksProvider'],
]);
