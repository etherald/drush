<?php

namespace Unish;
use \Drush\Sql\SqlTrait;

/**
  * Unit tests for expandWildcardTables() and filterTables().
  *
  * @group base
  * @group sql
  */
class WildcardUnitCase extends UnitUnishTestCase {

  use SqlTrait;

  /**
   * Tests drush_sql_expand_wildcard_tables().
   *
   * @see drush_sql_expand_wildcard_tables().
   */
  public function testExpandWildcardTables() {
    // Array of tables to search for.
    $wildcard_input = array(
      'cache*',
    );
    // Mock array of tables to test with. This is
    // also the expected result.
    $db_tables = array(
      'cache',
      'cache_bootstrap',
      'cache_field',
      'cache_filter',
      'cache_form',
      'cache_menu',
      'cache_page',
      'cache_path',
      'cache_update',
      'example',
    );

    $expanded_db_tables = $this->expandWildcardTables($wildcard_input, $db_tables);
    // We expect all but the last table to match.
    array_pop($db_tables);
    $this->assertEquals($db_tables, $expanded_db_tables);
  }

  /**
   * Tests drush_sql_filter_tables().
   *
   * @see drush_sql_filter_tables().
   */
  public function testFilterTables() {
    // Array of tables to search for.
    $wildcard_input = array(
      'cache',
      'cache_*',
    );
    // Mock array of tables to test with.
    $db_tables = array(
      'cache',
      'cache_bootstrap',
      'cache_field',
      'cache_filter',
      'cache_form',
      'cache_menu',
      'cache_page',
      'cache_path',
      'cache_update',
    );
    $expected_result = array(
      'cache',
    );

    $actual_result = $this->filterTables($wildcard_input, $db_tables);
    $this->assertEquals($expected_result, $actual_result);
  }
}
