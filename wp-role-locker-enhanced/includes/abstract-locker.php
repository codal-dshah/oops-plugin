<?php
namespace WPRoleLocker;

abstract class AbstractLocker {
    abstract protected function lock();
    abstract protected function unlock();
}