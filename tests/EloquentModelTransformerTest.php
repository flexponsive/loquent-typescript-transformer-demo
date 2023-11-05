<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use ReflectionClass;
use Spatie\TypeScriptTransformer\Structures\MissingSymbolsCollection;
use Spatie\TypeScriptTransformer\TypeScriptTransformerConfig;
use Spatie\LaravelTypeScriptTransformer\Transformers\EloquentModelTransformer;

class EloquentModelTransformerTest extends TestCase
{
    protected TypeScriptTransformerConfig $typescriptTransformerConfig;
    protected EloquentModelTransformer $transformer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->typescriptTransformerConfig = TypeScriptTransformerConfig::create();
        $this->transformer = new EloquentModelTransformer($this->typescriptTransformerConfig);
    }

    /**
     * A basic feature test example.
     */
    public function test_can_transform()
    {
        $cases = [
            \App\Models\User::class => true,
            \App\Http\Kernel::class => false,
        ];

        foreach ($cases as $className => $expected) {
            $reflectionClass = new ReflectionClass($className);
            $this->assertEquals(
                $expected,
                $this->transformer->canTransform($reflectionClass),
                $className
            );
        }
    }

    public function test_get_public_attributes()
    {
        $class = new ReflectionClass(\App\Models\User::class);
        $res = $this->transformer->getPublicAttributes($class);
        dd($res);
        $this->assertNull($res->firstWhere('name', 'password'), 'hidden field is excluded');
        $this->assertNotNull($res->firstWhere('name', 'name'));
    }

    public function test_transform_properties()
    {
        $missingSymbols = new MissingSymbolsCollection();
        $class = new ReflectionClass(\App\Models\User::class);
        $res = $this->transformer->transformProperties($class, $missingSymbols);
        dd($res);
    }

    public function test_cast_to_phpdocumentor_type()
    {
        $cases = [
            'datetime' => \phpDocumentor\Reflection\Types\String_::class,
            'hashed' => \phpDocumentor\Reflection\Types\String_::class,
            '\App\Enums\UserRole' => \phpDocumentor\Reflection\Types\Object_::class,
            'array' => \phpDocumentor\Reflection\Types\Array_::class,
            'AsStringable' => \phpDocumentor\Reflection\Types\String_::class,
            'boolean' => \phpDocumentor\Reflection\Types\Boolean::class,
            'immutable_date:Y-m-01' => \phpDocumentor\Reflection\Types\String_::class,
            'decimal:2' => \phpDocumentor\Reflection\Types\String_::class,
            'double' => \phpDocumentor\Reflection\Types\Float_::class,
            'encrypted' => \phpDocumentor\Reflection\Types\String_::class,
            'float' => \phpDocumentor\Reflection\Types\Float_::class,
            'object' => \phpDocumentor\Reflection\Types\Object_::class,
            'integer' => \phpDocumentor\Reflection\Types\Integer::class,
            'timestamp' => \phpDocumentor\Reflection\Types\Integer::class,
        ];

        foreach ($cases as $case => $expected) {
            $this->assertInstanceOf(
                $expected,
                $this->transformer->castToPhpdocumentorType($case),
                $case
            );
        }
    }

    public function test_get_public_relations()
    {
        $class = new ReflectionClass(\App\Models\User::class);
        $res = $this->transformer->getPublicRelations($class);

        dd($res);
    }

    public function test_get_pivot_typescript_type()
    {
        $missingSymbols = new MissingSymbolsCollection();
        $class = new ReflectionClass(\App\Models\OrgUnit::class);
        $res = $this->transformer->getPivotTypescriptType(
            $class,
            $missingSymbols,
            'businessFunctions'
        );

        dd($res);
    }
}
