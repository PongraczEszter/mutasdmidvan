describe('Bejelentkezés frontend tesztek', () => {
    it('Sikeres bejelentkezés esetén megjelenik a sikeres popup', () => {
      cy.intercept('POST', '**/bejelentkezes.php/bejelentkezes', {
        statusCode: 200,
        body: { uzenet: "Sikeres bejelentkezés" }
      }).as('loginRequest');
  
      cy.visit('http://localhost/a-te-oldalad/bejelentkezes.php');
  
      cy.get('#email').type('teszt@pelda.hu');
      cy.get('#jelszo').type('helyesjelszo');
      cy.get('form').submit();
  
      cy.wait('@loginRequest');
  

      cy.contains('Sikeres bejelenkezés').should('be.visible');
    });
  
    it('Hiányzó mezők esetén hiba popup jelenik meg', () => {
      cy.visit('http://localhost/a-te-oldalad/bejelentkezes.php');

      cy.get('#email').type(''); 
      cy.get('#jelszo').type('');
      cy.get('form').submit();
  
      cy.contains('Kérjük, töltsd ki az összes mezőt!').should('be.visible');
    });
  
    it('Hibás bejelentkezés esetén hiba popup', () => {
      cy.intercept('POST', '**/bejelentkezes.php/bejelentkezes', {
        statusCode: 401,
        body: {
          hibak: ["Hibás e-mail cím vagy jelszó!"]
        }
      }).as('loginRequest');
  
      cy.visit('http://localhost/a-te-oldalad/bejelentkezes.php');
  
      cy.get('#email').type('teszt@pelda.hu');
      cy.get('#jelszo').type('hibasjelszo');
      cy.get('form').submit();
  
      cy.wait('@loginRequest');
  
      cy.contains('Hibás e-mail cím vagy jelszó!').should('be.visible');
    });
  });
  