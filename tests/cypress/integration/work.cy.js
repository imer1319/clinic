describe('Citas medicas', () => {
  it('can list, show, create, edit and delete citas medicas', () => {
    cy.visit('/')
    .get('[data-cy=login]').click()
    cy.get('#username').type('Administrador')
    cy.get('#password').type('123123')
    cy.get('.btn').click();

    // Crear cita medica
    cy.get('[data-cy=cita]').click();
    cy.get('[data-cy=create-cita]').click();
    cy.get(':nth-child(2) > .fc-bg > table > tbody > tr > .fc-thu').click()
    cy.get('#time_start').invoke('val', '11:00').trigger('change')
    cy.get('#time_end').invoke('val', '13:00').trigger('change')
    cy.get('input[type=color]')
    .invoke('val', '#ff00ff')
    .trigger('change')
    cy.get('#doctor_id').select('Scotty Fisher')
    cy.get('#patient_id').select('Diana Carter')
    cy.get('[data-cy="subServ_9"]').check()
    cy.get('[data-cy="subServ_12"]').check()
    cy.get('[data-cy="subServ_1"]').check()
    cy.get('#observations').type("No tiene observaciones esta cita medica")
    cy.get('#addCita').click();
    cy.get('.fc-content').click()
  })

})