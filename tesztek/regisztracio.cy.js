describe('Regisztrációs űrlap frontend tesztek', () => {

  beforeEach(() => {
    cy.visit('http://localhost/a-te-oldalad/regisztracio.php'); 
  });

  it('Hibás jelszó formátumra hibát dob', () => {
    cy.get('input[name="vezeteknev"]').type('Teszt');
    cy.get('input[name="keresztnev"]').type('Elek');
    cy.get('input[name="email"]').type('teszt@pelda.hu');
    cy.get('#password').type('gyenge'); 

    cy.get('form').submit();

    cy.contains('A jelszónak legalább 8 karakter hosszúnak kell lennie').should('be.visible');
    cy.get('#password').should('have.class', 'error');
  });

  it('Hiányzó mezők esetén hiba popup jelenik meg', () => {
    cy.get('form').submit();

    cy.contains('Kérjük, töltsd ki az összes mezőt!').should('be.visible');
    cy.get('input').each($el => {
      cy.wrap($el).should('have.class', 'error');
    });
  });

  it('Sikeres regisztráció esetén siker popup', () => {
    cy.intercept('POST', '**/regisztracio.php/regisztracio', {
      statusCode: 200,
      body: {
        valasz: 'Sikeres regisztráció!'
      }
    }).as('regRequest');

    cy.get('input[name="vezeteknev"]').type('Teszt');
    cy.get('input[name="keresztnev"]').type('Elek');
    cy.get('input[name="email"]').type('teszt@pelda.hu');
    cy.get('#password').type('Jelszo123!');

    cy.get('form').submit();

    cy.wait('@regRequest');

    cy.contains('Sikeres regisztráció!').should('be.visible');
  });

  it('Jelszó láthatóság gomb működik', () => {
    cy.get('#password').type('Jelszo123!');
    cy.get('#password').should('have.attr', 'type', 'password');

    cy.get('#jelszo-lathatosag').click();
    cy.get('#password').should('have.attr', 'type', 'text');

    cy.get('#jelszo-lathatosag').click();
    cy.get('#password').should('have.attr', 'type', 'password');
  });
});
