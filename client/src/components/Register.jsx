import React , { useState } from 'react';
import '../assets/css/register.css';
function Register() {
  // États pour stocker les valeurs du formulaire
  const [formValues, setFormValues] = useState({
    nom: '',
    prenom: '',
    dateNaissance: '',
    pays: '',
    adresse: '',
    password: '',
    confirmPassword: '',
    telephone: '',
    kbis: '',
    gender: '', // Pour stocker le genre sélectionné
  });

  // Fonction pour gérer les changements dans les champs du formulaire
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormValues({
      ...formValues,
      [name]: value,
    });
  };

  // Fonction pour gérer la soumission du formulaire
  const handleSubmit = (e) => {
    e.preventDefault();

    console.log('Valeurs du formulaire : ', formValues);
    // Réinitialiser le formulaire après la soumission si nécessaire
    setFormValues({
      nom: '',
      prenom: '',
      dateNaissance: '',
      pays: '',
      adresse: '',
      password: '',
      confirmPassword: '',
      telephone: '',
      gender: '',
    });
  };

  return (
    <div className="flex-center flex-column">
    <div className='mt-80  form-zone'>

    <div class="flex-center">
                        <h1 class="title"> Crée votre compte </h1>
                    </div>

      <form action="" method="post">

        {/* checkboxes */}
        <div className="flex-center">

          <div className="field space-between flex">
            <div>
              <input
                className="checkbox"
                type="checkbox"
                id="female"
                name="gender"
              />
              <label htmlFor="female">Féminin</label>
            </div>

            <div>
              <input
                className="checkbox"
                type="checkbox"
                id="male"
                name="gender"
              />
              <label htmlFor="male">Masculin</label>
            </div>
          </div>
        </div>

        <div className="flex-column flex-center">
          <input
            className="field"
            type="text"
            name="nom"
            id="nom"
            placeholder="Nom"
          />
          <input
            className="field"
            type="text"
            name="prenom"
            id="prenom"
            placeholder="Prenom"
          />
          <input
            className="field"
            type="text"
            name="dateNaissance"
            id="dateNaissance"
            placeholder="Date de naissance"
          />
          <input
            className="field"
            type="text"
            name="pays"
            id="pays"
            placeholder="Pays"
          />
          <input
            className="field"
            type="text"
            name="adresse"
            id="adresse"
            placeholder="Adresse"
          />
          <input
            className="field"
            type="password"
            name="password"
            id="password"
            placeholder="Mot de passe"
          />
          <input
            className="field"
            type="password"
            name="confirmPassword"
            id="confirmPassword"
            placeholder="Confirmer mot de passe"
          />
          <input
            className="field"
            type="tel"
            name="telephone"
            id="telephone"
            placeholder="numéro de téléphone"
          />
          
        </div>

        <div className="flex-center">
          <button className="btn-submit" type="submit">
            VALIDER
          </button>
        </div>
      </form>
    </div>
    </div>
  );
}

export default Register;