import React, { useState, useEffect } from 'react';
import {useNavigate} from 'react-router-dom';
import axios, { Axios } from 'axios';

function Login() {
    let navigate = useNavigate();
    const [UserName, setUserName] = useState("");
    const [Password, setPassword] = useState("");

    const login = () =>  {
        axios.post("http://192.168.1.112:5001/login",{
          UserName: UserName,
          Password: Password,
      
        }).then((response) => {
      
          if (response.data.message) {
          }
          else {
            alert("Login Successful");
            navigate('/Home')
          }
        });
      };
    return(
        <div className='App'>
    <h1>Login</h1>

    <div className="form">
      <label>UserName</label>
   <input type="text" name="UserName" onChange={(e)=>{
    setUserName(e.target.value)
   }} 
   />
        <label>Password</label>-
   <input type="password" name="Password" onChange={(e)=>{
    setPassword(e.target.value)
   }} 
   />
   <button onClick={login}>Login</button>
   <button onClick={() => {navigate("/")}}>Register</button>

   </div>
  
   </div>
    );
}

export default Login;

