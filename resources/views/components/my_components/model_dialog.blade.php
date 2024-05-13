<!-- Bouton pour ouvrir le modal de connexion -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
  Connexion / Inscription
</button>

<!-- Modal de connexion / inscription -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="loginModalLabel">Connexion / Inscription</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <!-- Formulaire de connexion -->
              <form action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                      <label for="email" class="form-label">Adresse email</label>
                      <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="mb-3">
                      <label for="password" class="form-label">Mot de passe</label>
                      <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Connexion</button>
              </form>
              <!-- Formulaire d'inscription -->
              <form action="{{ route('register') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                      <label for="register_email" class="form-label">Adresse email</label>
                      <input type="email" class="form-control" id="register_email" name="email" required>
                  </div>
                  <div class="mb-3">
                      <label for="register_password" class="form-label">Mot de passe</label>
                      <input type="password" class="form-control" id="register_password" name="password" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Inscription</button>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          </div>
      </div>
  </div>
</div>

<!-- Assurez-vous d'inclure jQuery et Bootstrap JavaScript avant la fermeture du corps de votre page -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
