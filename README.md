jmlzf-helpers
=============

A collection of helpers for Zend Framework 2

[![Latest Stable Version](https://poser.pugx.org/jmleroux/jmlzf-helpers/v/stable.png)](https://packagist.org/packages/jmleroux/jmlzf-helpers)
[![Build Status](https://travis-ci.org/jmleroux/jmlzf-helpers.png)](https://travis-ci.org/jmleroux/jmlzf-helpers)
[![Coverage Status](https://coveralls.io/repos/jmleroux/jmlzf-helpers/badge.png)](https://coveralls.io/r/jmleroux/jmlzf-helpers)

### CurrentRoute

This helper gives access to the matched route in the view.
Useful for adding query params for example.

##### Usage
```php
<?php echo $this->currentRoute(); ?>
```

### QueryParams

This helper provides access to the query parameters as an associative array.

##### Usage
```php
<?php $queryParams = $this->queryParams(); ?>

<?php // do something with $queryParams ?>
```

### Sortable

This helper add or replace query parameters for sorting purpose.

##### Usage
```html
<table>
  <thead>
    <th>
      <a href="<?php echo $this->sortable('id'); ?>">ID</a>
    </th>
    <th>
      <a href="<?php echo $this->sortable('label'); ?>">Label</a>
    </th>
  </thead>
  <tbody>
  // table cells
  </tbody>
</table>

<?php // here goes the pagination control (with a paginate helper to come) ?>
```

Ouput :
```html
<table>
  <thead>
    <th>
      <a href="http://example.com/?sort=id&direction=asc">ID</a>
    </th>
    <th>
      <a href="http://example.com/?sort=label&direction=asc">Label</a>
    </th>
  </thead>
  <tbody>
  // table cells
  </tbody>
</table>
```
If you click on the ID column, the next output will be
```html
<table>
  <thead>
    <th>
      <a href="http://example.com/?sort=id&direction=desc">ID</a>
    </th>
    <th>
      <a href="http://example.com/?sort=label&direction=asc">Label</a>
    </th>
  </thead>
  <tbody>
  // table cells
  </tbody>
</table>
```

Maybe i'll wrap this one in another helper to be able to generate a class for the ```th``` element.

