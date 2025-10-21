<?php

if (!file_exists(__DIR__.'/src')) {
    exit(0);
}

return new PhpCsFixer\Config()
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRules([
        '@PHP71Migration' => true,
        '@PHP84Migration' => true,
        '@PHPUnit75Migration:risky' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        '@DoctrineAnnotation' => true,
        'protected_to_private' => false,
        'native_constant_invocation' => ['strict' => false],
        'modernize_strpos' => true,
        'get_class_to_class_keyword' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder(
        new PhpCsFixer\Finder()
            ->in(__DIR__.'/src')
            ->append([__FILE__])
    )
    ->setCacheFile('.php-cs-fixer.cache')
;
