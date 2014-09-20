phcollect
=========

PhCollect is a collections library for PHP which wraps PHP arrays and provides specialized, chainable, functions for different collection types.  This library is extensible and inheritable. All collections are immutable by default, though extended collections like lists and maps have functions that allow for collection mutation.

##Current functionality

**Static/Core**
- every(array, callable $userFn)
    - Performs user defined function on each element
    - escapable loop by returning false
- filter(array, callable $comparator)
    - Returns collection of all elements in original collection which $locator returns true for
- identity($value)
    - returns identity collection
- intersect(array[, array/collection, ...])
    - Variable arity -- accepts 1+ arrays or collections to perform intersection with
    - Returns original collection with intersection applied
- map(array, callable $modifier)
    - Returns new collection with $modifier function applied to all members of original collection
- partial(callable/array/string $userValue[, Mixed arguments])
    - Performs a right-partial application of passed values on provided function
    - Accepts static functions as an array of names: array(class name, function name)
    - Accepts internal static functions as a string: "function name"
- thread(collection/array, function[, function, ...])
    - Performs serial execution of passed functions using the output of the previous as the right-most argument of the next
    - Static only (collections implicitly allow function chaining/threading)
- union(array[, array/collection $dataset, ...])
    - Variable arity -- accepts 1+ arrays or collections to perform union with
    - Returns original collection with union applied

**Collection Interface**

- Core functions defined here
- every(callable $userFn)
    - Performs user defined function on each element
    - escapable loop by returning false
- filter(callable $comparator)
    - Returns collection of all elements in original collection which $locator returns true for
- find(callable $locator)
    - Returns first element $locator returns true for
- identity()
    - returns identity collection
- get(Mixed $index)
    - Returns collection value at the provided index
- length()
    - Returns count of elements in collection
- map(callable $modifier)
    - Returns new collection with $modifier function applied to all members of original collection
- partial(callable/array/string $userValue[, Mixed arguments])
    - Performs a right-partial application of passed values on provided function
    - Accepts static functions as an array of names: array(class name, function name)
    - Accepts internal static functions as a string: "function name"
- thread(collection/array, function[, function, ...])
    - Performs serial execution of passed functions using the output of the previous as the right-most argument of the next
    - Static only (collections implicitly allow function chaining/threading)
- toArray()
    - Returns a standard PHP associative of collection key/value pairs

**Tuples**

- first()
    - Returns first element in tuple
- fold(callable $userFn)
    - Returns the result of $userFn being applied serially, left to right, to each element using the previous result (like adding across all elements)
- last
    - Returns last element in the tuple
- nth(int $index)
    - Returns nth element in the tuple
- rest()
    - Returns new tuple containing all elements but the first of the original collection

**Lists**

- Inherits from tuple
- intersect(array/collection $dataset [...])
    - Variable arity -- accepts 1+ arrays or collections to perform intersection with
    - Returns original collection with intersection applied
- pop()
    - Pops last element from list and returns it
- push(Mixed $value)
    - Pushes new value on to the end of the list. Returns the updated list
- slice(int $offset[, int $length])
    - Returns a list containing a subset of the elements of the original based on the offset and length passed
- sort([callable $comparator])
    - Sorts list elements either in PHP sort standard order or using a comparator function
- union(array/collection $dataset [...])
    - Variable arity -- accepts 1+ arrays or collections to perform union with
    - Returns original collection with union applied

**Maps**

- set(PhTuple $tuple)
    - Adds key/value pair to map
    - Tuple must be an ordered pair representing a key and a value

##Upcoming development

Nothing upcoming