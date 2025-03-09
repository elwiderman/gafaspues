<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitCBFields
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPDesk\\CBFields\\' => 16,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPDesk\\CBFields\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $classMap = array (
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\AbstractLazyCollection' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/AbstractLazyCollection.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\ArrayCollection' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/ArrayCollection.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\Collection' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/Collection.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\Criteria' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/Criteria.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\Expr\\ClosureExpressionVisitor' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/Expr/ClosureExpressionVisitor.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\Expr\\Comparison' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/Expr/Comparison.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\Expr\\CompositeExpression' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/Expr/CompositeExpression.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\Expr\\Expression' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/Expr/Expression.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\Expr\\ExpressionVisitor' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/Expr/ExpressionVisitor.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\Expr\\Value' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/Expr/Value.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\ExpressionBuilder' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/ExpressionBuilder.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\ReadableCollection' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/ReadableCollection.php',
        'CBFieldsVendor\\Doctrine\\Common\\Collections\\Selectable' => __DIR__ . '/../..' . '/vendor_prefixed/doctrine/collections/lib/Doctrine/Common/Collections/Selectable.php',
        'CBFieldsVendor\\Psr\\Clock\\ClockInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/clock/src/ClockInterface.php',
        'CBFieldsVendor\\Psr\\Container\\ContainerExceptionInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/container/src/ContainerExceptionInterface.php',
        'CBFieldsVendor\\Psr\\Container\\ContainerInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/container/src/ContainerInterface.php',
        'CBFieldsVendor\\Psr\\Container\\NotFoundExceptionInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/container/src/NotFoundExceptionInterface.php',
        'CBFieldsVendor\\Psr\\EventDispatcher\\EventDispatcherInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/event-dispatcher/src/EventDispatcherInterface.php',
        'CBFieldsVendor\\Psr\\EventDispatcher\\ListenerProviderInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/event-dispatcher/src/ListenerProviderInterface.php',
        'CBFieldsVendor\\Psr\\EventDispatcher\\StoppableEventInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/event-dispatcher/src/StoppableEventInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Client\\ClientExceptionInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-client/src/ClientExceptionInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Client\\ClientInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-client/src/ClientInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Client\\NetworkExceptionInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-client/src/NetworkExceptionInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Client\\RequestExceptionInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-client/src/RequestExceptionInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\MessageInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-message/src/MessageInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\RequestFactoryInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-factory/src/RequestFactoryInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\RequestInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-message/src/RequestInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\ResponseFactoryInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-factory/src/ResponseFactoryInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\ResponseInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-message/src/ResponseInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\ServerRequestFactoryInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-factory/src/ServerRequestFactoryInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\ServerRequestInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-message/src/ServerRequestInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\StreamFactoryInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-factory/src/StreamFactoryInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\StreamInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-message/src/StreamInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\UploadedFileFactoryInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-factory/src/UploadedFileFactoryInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\UploadedFileInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-message/src/UploadedFileInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\UriFactoryInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-factory/src/UriFactoryInterface.php',
        'CBFieldsVendor\\Psr\\Http\\Message\\UriInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/http-message/src/UriInterface.php',
        'CBFieldsVendor\\Psr\\Log\\AbstractLogger' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/AbstractLogger.php',
        'CBFieldsVendor\\Psr\\Log\\InvalidArgumentException' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/InvalidArgumentException.php',
        'CBFieldsVendor\\Psr\\Log\\LogLevel' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/LogLevel.php',
        'CBFieldsVendor\\Psr\\Log\\LoggerAwareInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/LoggerAwareInterface.php',
        'CBFieldsVendor\\Psr\\Log\\LoggerAwareTrait' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/LoggerAwareTrait.php',
        'CBFieldsVendor\\Psr\\Log\\LoggerInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/LoggerInterface.php',
        'CBFieldsVendor\\Psr\\Log\\LoggerTrait' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/LoggerTrait.php',
        'CBFieldsVendor\\Psr\\Log\\NullLogger' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/NullLogger.php',
        'CBFieldsVendor\\Psr\\Log\\Test\\DummyTest' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/Test/DummyTest.php',
        'CBFieldsVendor\\Psr\\Log\\Test\\LoggerInterfaceTest' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'CBFieldsVendor\\Psr\\Log\\Test\\TestLogger' => __DIR__ . '/../..' . '/vendor_prefixed/psr/log/Psr/Log/Test/TestLogger.php',
        'CBFieldsVendor\\Psr\\SimpleCache\\CacheException' => __DIR__ . '/../..' . '/vendor_prefixed/psr/simple-cache/src/CacheException.php',
        'CBFieldsVendor\\Psr\\SimpleCache\\CacheInterface' => __DIR__ . '/../..' . '/vendor_prefixed/psr/simple-cache/src/CacheInterface.php',
        'CBFieldsVendor\\Psr\\SimpleCache\\InvalidArgumentException' => __DIR__ . '/../..' . '/vendor_prefixed/psr/simple-cache/src/InvalidArgumentException.php',
        'CBFieldsVendor\\WPDesk\\Notice\\AjaxHandler' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-notice/src/WPDesk/Notice/AjaxHandler.php',
        'CBFieldsVendor\\WPDesk\\Notice\\Factory' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-notice/src/WPDesk/Notice/Factory.php',
        'CBFieldsVendor\\WPDesk\\Notice\\Notice' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-notice/src/WPDesk/Notice/Notice.php',
        'CBFieldsVendor\\WPDesk\\Notice\\PermanentDismissibleNotice' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-notice/src/WPDesk/Notice/PermanentDismissibleNotice.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\BuildDirector\\LegacyBuildDirector' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/BuildDirector/LegacyBuildDirector.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Builder\\AbstractBuilder' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Builder/AbstractBuilder.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Builder\\InfoActivationBuilder' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Builder/InfoActivationBuilder.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Builder\\InfoBuilder' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Builder/InfoBuilder.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\AbstractPlugin' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/AbstractPlugin.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\Activateable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/Activateable.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\ActivationAware' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/ActivationAware.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\ActivationTracker' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/ActivationTracker.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\Conditional' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/Conditional.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\Deactivateable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/Deactivateable.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\Hookable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/Hookable.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\HookableCollection' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/HookableCollection.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\HookableParent' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/HookableParent.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\HookablePluginDependant' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/HookablePluginDependant.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\PluginAccess' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/PluginAccess.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\SlimPlugin' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/SlimPlugin.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Plugin\\TemplateLoad' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/TemplateLoad.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Storage\\Exception\\ClassAlreadyExists' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/Exception/ClassAlreadyExists.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Storage\\Exception\\ClassNotExists' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/Exception/ClassNotExists.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Storage\\PluginStorage' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/PluginStorage.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Storage\\StaticStorage' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/StaticStorage.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Storage\\StorageFactory' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/StorageFactory.php',
        'CBFieldsVendor\\WPDesk\\PluginBuilder\\Storage\\WordpressFilterStorage' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Storage/WordpressFilterStorage.php',
        'CBFieldsVendor\\WPDesk\\Plugin\\Flow\\Initialization\\BuilderTrait' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/Initialization/BuilderTrait.php',
        'CBFieldsVendor\\WPDesk\\Plugin\\Flow\\Initialization\\InitializationFactory' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/Initialization/InitializationFactory.php',
        'CBFieldsVendor\\WPDesk\\Plugin\\Flow\\Initialization\\InitializationStrategy' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/Initialization/InitializationStrategy.php',
        'CBFieldsVendor\\WPDesk\\Plugin\\Flow\\Initialization\\PluginDisablerByFileTrait' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/Initialization/PluginDisablerByFileTrait.php',
        'CBFieldsVendor\\WPDesk\\Plugin\\Flow\\Initialization\\Simple\\SimpleFactory' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/Initialization/Simple/SimpleFactory.php',
        'CBFieldsVendor\\WPDesk\\Plugin\\Flow\\Initialization\\Simple\\SimpleFreeStrategy' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/Initialization/Simple/SimpleFreeStrategy.php',
        'CBFieldsVendor\\WPDesk\\Plugin\\Flow\\Initialization\\Simple\\SimplePaidStrategy' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/Initialization/Simple/SimplePaidStrategy.php',
        'CBFieldsVendor\\WPDesk\\Plugin\\Flow\\Initialization\\Simple\\TrackerInstanceAsFilterTrait' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/Initialization/TrackerInstanceAsFilterTrait.php',
        'CBFieldsVendor\\WPDesk\\Plugin\\Flow\\PluginBootstrap' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/PluginBootstrap.php',
        'CBFieldsVendor\\WPDesk\\Tracker\\Assets' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/PSR/WPDesk/Tracker/Assets.php',
        'CBFieldsVendor\\WPDesk\\Tracker\\OptInOptOut' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/PSR/WPDesk/Tracker/OptInOptOut.php',
        'CBFieldsVendor\\WPDesk\\Tracker\\OptInPage' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/PSR/WPDesk/Tracker/OptInPage.php',
        'CBFieldsVendor\\WPDesk\\Tracker\\OptOut' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/PSR/WPDesk/Tracker/OptOut.php',
        'CBFieldsVendor\\WPDesk\\Tracker\\PluginActionLinks' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/PSR/WPDesk/Tracker/PluginActionLinks.php',
        'CBFieldsVendor\\WPDesk\\Tracker\\Shop' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/PSR/WPDesk/Tracker/Shop.php',
        'CBFieldsVendor\\WPDesk\\View\\PluginViewBuilder' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/PluginViewBuilder.php',
        'CBFieldsVendor\\WPDesk\\View\\Renderer\\LoadTemplatePlugin' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/Renderer/LoadTemplatePlugin.php',
        'CBFieldsVendor\\WPDesk\\View\\Renderer\\Renderer' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/Renderer/Renderer.php',
        'CBFieldsVendor\\WPDesk\\View\\Renderer\\SimplePhpRenderer' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/Renderer/SimplePhpRenderer.php',
        'CBFieldsVendor\\WPDesk\\View\\Resolver\\ChainResolver' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/Resolver/ChainResolver.php',
        'CBFieldsVendor\\WPDesk\\View\\Resolver\\DirResolver' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/Resolver/DirResolver.php',
        'CBFieldsVendor\\WPDesk\\View\\Resolver\\Exception\\CanNotResolve' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/Resolver/Exception/CanNotResolve.php',
        'CBFieldsVendor\\WPDesk\\View\\Resolver\\NullResolver' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/Resolver/NullResolver.php',
        'CBFieldsVendor\\WPDesk\\View\\Resolver\\Resolver' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/Resolver/Resolver.php',
        'CBFieldsVendor\\WPDesk\\View\\Resolver\\WPThemeResolver' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/Resolver/WPThemeResolver.php',
        'CBFieldsVendor\\WPDesk\\View\\Resolver\\WooTemplateResolver' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-view/src/Resolver/WooTemplateResolver.php',
        'CBFieldsVendor\\WPDesk_Basic_Requirement_Checker' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-basic-requirements/src/Basic_Requirement_Checker.php',
        'CBFieldsVendor\\WPDesk_Basic_Requirement_Checker_Factory' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-basic-requirements/src/Basic_Requirement_Checker_Factory.php',
        'CBFieldsVendor\\WPDesk_Basic_Requirement_Checker_With_Update_Disable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-basic-requirements/src/Basic_Requirement_Checker_With_Update_Disable.php',
        'CBFieldsVendor\\WPDesk_Buildable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/WithoutNamespace/Buildable.php',
        'CBFieldsVendor\\WPDesk_Has_Plugin_Info' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/WithoutNamespace/Has_Plugin_Info.php',
        'CBFieldsVendor\\WPDesk_Plugin_Info' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/WithoutNamespace/Plugin_Info.php',
        'CBFieldsVendor\\WPDesk_Requirement_Checker' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-basic-requirements/src/Requirement_Checker.php',
        'CBFieldsVendor\\WPDesk_Requirement_Checker_Factory' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-basic-requirements/src/Requirement_Checker_Factory.php',
        'CBFieldsVendor\\WPDesk_Tracker' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/class-wpdesk-tracker.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Gateways' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-gateways.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Identification' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-identification.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Identification_Gdpr' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-identification-gdpr.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Jetpack' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-jetpack.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_License_Emails' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-license-emails.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Orders' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-orders.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Orders_Country' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-orders-country.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Orders_Month' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-orders-month.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Plugins' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-plugins.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Products' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-products.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Products_Variations' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-products-variations.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Server' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-server.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Settings' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-settings.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Shipping_Classes' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-shipping-classes.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Shipping_Methods' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-shipping-methods.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Shipping_Methods_Zones' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-shipping-methods-zones.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Templates' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-templates.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Theme' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-theme.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_User_Agent' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-user-agent.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Users' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-users.php',
        'CBFieldsVendor\\WPDesk_Tracker_Data_Provider_Wordpress' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/data_provider/class-wpdesk-tracker-data-provider-wordpress.php',
        'CBFieldsVendor\\WPDesk_Tracker_Factory_Prefixed' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/class-wpdesk-tracker-factory-prefixed.php',
        'CBFieldsVendor\\WPDesk_Tracker_Interface' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/class-wpdesk-tracker-interface.php',
        'CBFieldsVendor\\WPDesk_Tracker_Persistence_Consent' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/persistence/class-wpdesk-tracker-persistence-consent.php',
        'CBFieldsVendor\\WPDesk_Tracker_Sender' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/sender/class-wpdesk-tracker-sender.php',
        'CBFieldsVendor\\WPDesk_Tracker_Sender_Exception_WpError' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/sender/Exception/class-wpdesk-tracker-sender-exception-wperror.php',
        'CBFieldsVendor\\WPDesk_Tracker_Sender_Logged' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/sender/class-wpdesk-tracker-sender-logged.php',
        'CBFieldsVendor\\WPDesk_Tracker_Sender_Wordpress_To_WPDesk' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-wpdesk-tracker/src/sender/class-wpdesk-tracker-sender-wordpress-to-wpdesk.php',
        'CBFieldsVendor\\WPDesk_Translable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/WithoutNamespace/Translable.php',
        'CBFieldsVendor\\WPDesk_Translatable' => __DIR__ . '/../..' . '/vendor_prefixed/wpdesk/wp-builder/src/Plugin/WithoutNamespace/Translatable.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Psr\\Log\\AbstractLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/AbstractLogger.php',
        'Psr\\Log\\InvalidArgumentException' => __DIR__ . '/..' . '/psr/log/Psr/Log/InvalidArgumentException.php',
        'Psr\\Log\\LogLevel' => __DIR__ . '/..' . '/psr/log/Psr/Log/LogLevel.php',
        'Psr\\Log\\LoggerAwareInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareInterface.php',
        'Psr\\Log\\LoggerAwareTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareTrait.php',
        'Psr\\Log\\LoggerInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerInterface.php',
        'Psr\\Log\\LoggerTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerTrait.php',
        'Psr\\Log\\NullLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/NullLogger.php',
        'Psr\\Log\\Test\\DummyTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/DummyTest.php',
        'Psr\\Log\\Test\\LoggerInterfaceTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'Psr\\Log\\Test\\TestLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/TestLogger.php',
        'WPDesk\\CBFields\\Blocks\\AbstractBlock' => __DIR__ . '/../..' . '/inc/Blocks/AbstractBlock.php',
        'WPDesk\\CBFields\\Blocks\\CheckboxBlock' => __DIR__ . '/../..' . '/inc/Blocks/CheckboxBlock.php',
        'WPDesk\\CBFields\\Blocks\\InputEmailBlock' => __DIR__ . '/../..' . '/inc/Blocks/InputEmailBlock.php',
        'WPDesk\\CBFields\\Blocks\\InputNumberBlock' => __DIR__ . '/../..' . '/inc/Blocks/InputNumberBlock.php',
        'WPDesk\\CBFields\\Blocks\\InputTextBlock' => __DIR__ . '/../..' . '/inc/Blocks/InputTextBlock.php',
        'WPDesk\\CBFields\\Blocks\\InputUrlBlock' => __DIR__ . '/../..' . '/inc/Blocks/InputUrlBlock.php',
        'WPDesk\\CBFields\\Blocks\\SelectBlock' => __DIR__ . '/../..' . '/inc/Blocks/SelectBlock.php',
        'WPDesk\\CBFields\\Blocks\\TextareaBlock' => __DIR__ . '/../..' . '/inc/Blocks/TextareaBlock.php',
        'WPDesk\\CBFields\\Collection\\ExtensionDataBag' => __DIR__ . '/../..' . '/inc/Collection/ExtensionDataBag.php',
        'WPDesk\\CBFields\\Collection\\FieldSettings' => __DIR__ . '/../..' . '/inc/Collection/FieldSettings.php',
        'WPDesk\\CBFields\\Collection\\FieldSettingsCollection' => __DIR__ . '/../..' . '/inc/Collection/FieldSettingsCollection.php',
        'WPDesk\\CBFields\\Collection\\FieldSettingsCollectionFactory' => __DIR__ . '/../..' . '/inc/Collection/FieldSettingsCollectionFactory.php',
        'WPDesk\\CBFields\\Data\\FieldsMetaResolver' => __DIR__ . '/../..' . '/inc/Data/FieldsMetaResolver.php',
        'WPDesk\\CBFields\\Exceptions\\FieldMetaException' => __DIR__ . '/../..' . '/inc/Exceptions/FieldMetaException.php',
        'WPDesk\\CBFields\\Hookable\\Display\\DisplayBase' => __DIR__ . '/../..' . '/inc/Hookable/Display/DisplayBase.php',
        'WPDesk\\CBFields\\Hookable\\Display\\OrderAdmin' => __DIR__ . '/../..' . '/inc/Hookable/Display/OrderAdmin.php',
        'WPDesk\\CBFields\\Hookable\\Display\\OrderConfirmation' => __DIR__ . '/../..' . '/inc/Hookable/Display/OrderConfirmation.php',
        'WPDesk\\CBFields\\Hookable\\Display\\OrderEmail' => __DIR__ . '/../..' . '/inc/Hookable/Display/OrderEmail.php',
        'WPDesk\\CBFields\\Hookable\\Display\\OrderMyAccount' => __DIR__ . '/../..' . '/inc/Hookable/Display/OrderMyAccount.php',
        'WPDesk\\CBFields\\Hookable\\OrderSaver' => __DIR__ . '/../..' . '/inc/Hookable/OrderSaver.php',
        'WPDesk\\CBFields\\Hookable\\Registrator\\BlockCategories' => __DIR__ . '/../..' . '/inc/Hookable/Registrator/BlockCategories.php',
        'WPDesk\\CBFields\\Hookable\\Registrator\\BlockEndpointSchema' => __DIR__ . '/../..' . '/inc/Hookable/Registrator/BlockEndpointSchema.php',
        'WPDesk\\CBFields\\Hookable\\Registrator\\BlockNamespace' => __DIR__ . '/../..' . '/inc/Hookable/Registrator/BlockNamespace.php',
        'WPDesk\\CBFields\\Hookable\\Registrator\\Blocks' => __DIR__ . '/../..' . '/inc/Hookable/Registrator/Blocks.php',
        'WPDesk\\CBFields\\Hookable\\SettingsSaver' => __DIR__ . '/../..' . '/inc/Hookable/SettingsSaver.php',
        'WPDesk\\CBFields\\Plugin' => __DIR__ . '/../..' . '/inc/Plugin.php',
        'WPDesk\\Helper\\HelperAsLibrary' => __DIR__ . '/..' . '/wpdesk/wp-wpdesk-helper-override/src/Helper/HelperAsLibrary.php',
        'WPDesk_Tracker_Data_Provider' => __DIR__ . '/..' . '/wpdesk/wp-wpdesk-helper-override/src/Interop/Tracker/class-wpdesk-tracker-data-provider.php',
        'WPDesk_Tracker_Factory' => __DIR__ . '/..' . '/wpdesk/wp-wpdesk-helper-override/src/Helper/TrackerFactory.php',
        'WPDesk_Tracker_Interface' => __DIR__ . '/..' . '/wpdesk/wp-wpdesk-helper-override/src/Interop/Tracker/class-wpdesk-tracker-interface.php',
        'WPDesk_Tracker_Sender' => __DIR__ . '/..' . '/wpdesk/wp-wpdesk-helper-override/src/Interop/Tracker/class-wpdesk-tracker-sender.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitCBFields::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitCBFields::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitCBFields::$classMap;

        }, null, ClassLoader::class);
    }
}
