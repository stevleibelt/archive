@restler
Feature: Identify valid user

  Scenario: I should get back a boolean true for a valid user
      Given that "usnermame" is set to "foo"
        AND "password" is set to "bar"
      When I request "/identify/user{?username,password}"
          Then the response is json
            AND the type is "string"
            AND the value is "true" 
