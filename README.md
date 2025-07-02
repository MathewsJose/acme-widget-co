# Acme Widget Co - Sales Basket Proof of Concept

It models a simple shopping basket with product catalog, delivery rules, and promotional offers, implemented in clean, maintainable PHP 8.3 code.

---

## Features

- **Product catalog** with pricing for three widget types:
  - Red Widget (R01) - $32.95
  - Green Widget (G01) - $24.95
  - Blue Widget (B01) - $7.95

- **Delivery charge rules**:
  - Orders under $50: $4.95 delivery
  - Orders under $90: $2.95 delivery
  - Orders $90 or more: free delivery

- **Promotional offer**:
  - Buy one Red Widget (R01), get the second Red Widget half price

- Fully tested with PHPUnit

---

## Approach & Design

- **Clean architecture principles**: The system uses small, focused classes and interfaces to separate concerns.
- **Strategy pattern**: Offers implement an `OfferInterface` which allows easy addition of new promotions without modifying core basket logic.
- **Dependency injection**: The basket receives product catalog, delivery rules, and offers on initialization, making it easy to extend or modify.
- **Precise pricing logic**: Rounding and currency handling carefully implemented to avoid floating-point errors common in money calculations.
- **Simple CLI runner**: Easy to test manually from command line by passing product codes as arguments.
- **Unit tested**: Key scenarios and edge cases are covered in PHPUnit tests to ensure correct pricing calculations.

---

## Installation

Requires PHP 8.3 and Composer.

```bash
git clone <repository-url>
cd acme-widget-co
composer install
```

## Usage

Run from CLI, passing product codes as arguments:

```bash
php bin/run.php R01 R01 G01
```

## Output

```bash
Total: $77.32
```


## Running Tests

PHPUnit tests are included for all example baskets and offer calculations.

```bash
vendor/bin/phpunit
```

## Assumptions

- Product prices and delivery rules are passed as arrays during basket initialization.
- The offer "buy one red widget, get second half price" only applies to pairs of red widgets.
- Delivery cost is applied after all offers and discounts.
- Prices and totals are rounded down to the nearest cent to avoid floating point rounding errors.
- No UI or database integration; this is a backend logic proof of concept only.

## Possible Improvements

- Add support for multiple simultaneous offers and stacking rules.
- Implement additional offers using the existing offer interface.
- Support quantity input and removal of items from basket.
- Add integration tests or acceptance tests.
- Create a REST API or web frontend for interactive usage.
- Use Docker for environment consistency and easy onboarding.


