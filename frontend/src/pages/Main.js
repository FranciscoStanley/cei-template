import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import './Main.css';

import api from '../services/api';

import logo from '../assets/logo.png';
import load from '../assets/load.gif';
import check from '../assets/check.gif';
import block from '../assets/block.gif';

export default function Main({ match }) {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    async function loadUsers() {
      const response = await api.post('/matricula', {
        matricula : match.params.matricula,
      })
      
      setUsers([response.data]);
    }

    loadUsers();
  }, [match.params.matricula]);


  return (
    <div className="main-container">
      <Link to="/">
        <img src={logo} width="20%" alt="Wyden Tech" />
      </Link>
      { users.length > 0 ? (
        <div className="resposta">
          {users.map(user => (
            <div key={user.id}>
              <h1>Olá. Bem Vindo {user.name}</h1>
                {user.status == 0 ? 
                (
                <div>
                  <h3>Estamos Analisando seu perfil! por favor aguarde e tente novamente mais tarde</h3>
                  <img src={load} width="20%" alt="Wyden Tech" /> 
                </div>) : user.status == 1 ? 
                 (<div>
                  <h3>Parabens seu perfil foi aceito aguarde instruçes por e-mail</h3>
                  <img src={check} width="20%" alt="Wyden Tech" /> 
                </div>) : user.status == 2 ? (
                <div>
                <h3>Seu perfil não foi aceito tente novamente na proxima! : (</h3>
                <img src={block} width="20%" alt="Wyden Tech" /> 
              </div>
               ) : (<div></div>)}
                <footer align="left">
                  <h5>Nome:{user.name}</h5>
                  <h5>E-mail:{user.emai}</h5>
                  <h5>Curso:{user.curso}</h5>
                  <h5>Matricula:{user.matricula}</h5>
                </footer>
            </div>

          ))}

       </div>
      ) : (
        <div className="empty">Nada encontrado aqui :(</div>
      ) }
    </div>
  )
}