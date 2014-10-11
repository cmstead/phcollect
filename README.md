phcollect
=========

PhCollect is a collections library for PHP which wraps PHP arrays and provides specialized, chainable, functions for different collection types.  This library is extensible and inheritable. All collections are immutable by default, though extended collections like lists and maps have functions that allow for collection mutation.

##Current functionality

**Static/Core**
- every(array, callable $userFn)
    - O(n)
    - Performs user defined function on each element
    - escapable loop by returning false
- filter(array, callable $comparator)
    - O(n)
    - Returns collection of all elements in original collection which $locator returns true for
- identity($value)
    - O(1)
    - returns identity collection
- intersect(array[, array/collection, ...])
    - O(n log n) per array pair
    - Variable arity -- accepts 1+ arrays or collections to perform intersection with
    - Returns original collection with intersection applied
- map(array, callable $modifier)
    - O(n)
    - Returns new collection with $modifier function applied to all members of original collection
- partial(callable/array/string $userValue[, Mixed arguments])
    - O(1)
    - Performs a right-partial application of passed values on provided function
    - Accepts static functions as an array of names: array(class name, function name)
    - Accepts internal static functions as a string: "function name"
- thread(collection/array, function[, function, ...])
    - O(n)
    - Performs serial execution of passed functions using the output of the previous as the right-most argument of the next
    - Static only (collections implicitly allow function chaining/threading)
- union(array[, array/collection $dataset, ...])
    - O(n log n) per array pair
    - Variable arity -- accepts 1+ arrays or collections to perform union with
    - Returns original collection with union applied

**Collection Base**

- Core functions defined here
- every(callable $userFn)
    - O(n)
    - Performs user defined function on each element
    - escapable loop by returning false
- filter(callable $comparator)
    - O(n)
    - Returns collection of all elements in original collection which $locator returns true for
- find(callable $locator)
    - O(n)
    - Returns first element $locator returns true for
- identity()
    - O(1)
    - returns identity collection
- get(Mixed $index)
    - O(1)
    - Returns collection value at the provided index
- length()
    - O(1)
    - Returns count of elements in collection
- map(callable $modifier)
    - O(n)
    - Returns new collection with $modifier function applied to all members of original collection
- partial(callable/array/string $userValue[, Mixed arguments])
    - O(n)
    - Performs a right-partial application of passed values on provided function
    - Accepts static functions as an array of names: array(class name, function name)
    - Accepts internal static functions as a string: "function name"
- thread(collection/array, function[, function, ...])
    - O(n)
    - Performs serial execution of passed functions using the output of the previous as the right-most argument of the next
    - Static only (collections implicitly allow function chaining/threading)
- toArray()
    O(1)
    - Returns a standard PHP associative of collection key/value pairs

**Tuples**

- first()
    - O(1)
    - Returns first element in tuple
- fold(callable $userFn)
    - O(n)
    - Returns the result of $userFn being applied serially, left to right, to each element using the previous result (like adding across all elements)
- last
    - O(1)
    - Returns last element in the tuple
- nth(int $index)
    - O(1)
    - Returns nth element in the tuple
- rest()
    - O(n)
    - Returns new tuple containing all elements but the first of the original collection

**Lists**

- Inherits from tuple
- add(int $key, mixed $value)
    - O(n)
    - Inserts a value into list at key location
- clear()
    - O(1)
    - Clears all values out of list
- contains(mixed $value)
    - O(n);
    - Verifies value can be found in array
    - Returns true upon finding a match, false otherwise
- delete(int $key)
    - O(n)
    - Removes element at $key location
    - Does not create sparse collection
- indexOf(mixed $value)
    - O(n)
    - Returns first index of matching value
- intersect(array/collection $dataset [...])
    - O(n log n) per array pair
    - Variable arity -- accepts 1+ arrays or collections to perform intersection with
    - Returns original collection with intersection applied
- pop()
    - O(1)
    - Pops last element from list and returns it
- push(Mixed $value)
    - O(sum n)
    - Pushes new value on to the end of the list. Returns the updated list
- slice(int $offset[, int $length])
    - O(n)
    - Returns a list containing a subset of the elements of the original based on the offset and length passed
- sort([callable $comparator])
    - O(n log n)
    - Sorts list elements either in PHP sort standard order or using a comparator function
- union(array/collection $dataset [...])
    - O(n log n)
    - Variable arity -- accepts 1+ arrays or collections to perform union with
    - Returns original collection with union applied

**Maps**

- set(PhTuple $tuple)
    - O(1)
    - Adds key/value pair to map
    - Tuple must be an ordered pair representing a key and a value

##Upcoming development

Nothing upcoming