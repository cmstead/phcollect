phcollect
=========

PhCollect is a collections library for PHP which wraps PHP arrays and provides specialized, chainable, functions for different collection types.  This library is extensible and inheritable. All collections are immutable by default, though extended collections like lists and maps have functions that allow for collection mutation.

##Current development

**Collection Interface**

- Core functions defined here
- get(Mixed $index)
    - Returns collection value at the provided index
- length()
    - Returns count of elements in collection
- toArray()
    - Returns a standard PHP associative of collection key/value pairs

**Tuples**

- first()
    - Returns first element in tuple
- last
    - Returns last element in the tuple
- nth(int $index)
    - Returns nth element in the tuple
- rest()
    - Returns new tuple containing all elements but the first of the original collection

**Lists**

- Inherits from tuple
- pop()
    - Pops last element from list and returns it
- push(Mixed $value)
    - Pushes new value on to the end of the list. Returns the updated list
- slice(int $offset[, int $length])
    - Returns a list containing a subset of the elements of the original based on the offset and length passed
- sort([callable $comparator])
    - Sorts list elements either in PHP sort standard order or using a comparator function

**Maps**

- set(PhTuple $tuple)
    - Adds key/value pair to map
    - Tuple must be an ordered pair representing a key and a value

##Upcoming development

**Collection Interface**

- filter(callable $locator)
    - Returns collection of all elements in original collection which $locator returns true for
- find(callable $locator)
    - Returns first element $locator returns true for
- fold(callable $userFn)
    - Returns the result of $userFn being applied serially, left to right, to each element using the previous result (like adding across all elements)
- map(callable $modifier)
    - Returns new collection with $modifier function applied to all members of original collection
