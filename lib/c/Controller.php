<?php


/**
 * Class Controller базовый абстрактный класс Контролёра
 * задающий основной интерфейс потомкам и концепту действий контролёров.
 * методы:
 * -- Абстрактные
 * OnInput()  void
 * OnOutput() void
 * -- Определенные
 * Request()  void
 * IsGet()    boolean
 * IsPost()   boolean
 * Render() string
 *
 * Целм и смысл абстрактных методов:
 * OnInput()  void - метод делает начальную работу при полученых даных от клиента:
 *                   запросы БД, подготовка полученного.
 * OnOutPut() void - метод выполняет работу по реализации передачи данных клиенту
 */
abstract class Controller
{
  /**
   * Загрузка стандортной работой
   * $this->OnInput();  - работа с входными данными
   * $this->OnOutput(); - работа с выходными данными
   */
  public function Request()
  {
    $this->OnInput();
    $this->OnOutput();
  }

  /**
   * Перечень процедур для работы с входными данными
   */
  abstract protected function OnInput();

  /**
   * Перечень процедур для работы с выходными данными
   */
  abstract protected function OnOutput();

  /**
   * Проверка текущего метода HTTP REQUEST
   * @return bool - если HTTP REQUEST METHOD = GET
   */
  protected function IsGet()
  {
    return ($_SERVER['REQUEST_METHOD'] === 'GET');
  }

  /**
   * Проверка текущего метода HTTP REQUEST
   * @return bool - если HTTP REQUEST METHOD = POST
   */
  protected function IsPost()
  {
    return ($_SERVER['REQUEST_METHOD'] === 'POST');
  }
}





