Feature: Testando o repositório
    Scenario: "create `Classic` plus `chocolate`"
        Given Create 'Classic' plus 'chocolate'
        Then I shouldBe '["banana", "chocolate","honey","ice","mango","peach","pineapple","strawberry", "yogurt"]'

    Scenario: "create `Classic` plus `chocolate` minus `strawberry`"
        Given Create 'Classic' plus 'chocolate' minus 'strawberry'
        Then I shouldBe '["banana", "chocolate","honey","ice","mango","peach","pineapple","yogurt"]'

    Scenario: "create `Classic` smoothie"
        Given Create 'Classic'
        Then I shouldBe '["banana","honey","ice","mango","peach","pineapple","strawberry","yogurt"]'

    Scenario: "create `Classic` minus `strawberry`"
        Given Create 'Classic' minus 'strawberry'
        Then I shouldBe '["banana","honey","ice","mango","peach","pineapple","yogurt"]'

    Scenario: "create `Just Desserts` smoothie"
        Given Create 'Just Desserts'
        Then I shouldBe '["banana","cherry","chocolate","ice cream","peanut"]'

    Scenario: "create `Just Desserts` smoothie without `ice cream` and `peanut`"
        Given Create All 'Just Desserts,-ice cream,-peanut'
        Then I shouldBe '["banana","cherry","chocolate"]'

    Scenario: "create a smoothie without ingredients"
        Given Create All 'Just Desserts,-banana,-cherry,-chocolate,-ice cream,-peanut'
        Then I shouldBe '[]'

    Scenario: "exclude unused ingredients"
        Given Create All 'Classic,-banana,-mango,-peanut'
        Then I shouldBe '["honey","ice","peach","pineapple","strawberry","yogurt"]'
