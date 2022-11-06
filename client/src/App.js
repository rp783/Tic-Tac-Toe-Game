import React, { useState, useEffect } from 'react';
import './App.css';
import axios, { Axios } from 'axios';
import {useNavigate} from "react-router-dom";

function App() {
const [ID, setID] = useState("");
const [UserName, setUserName] = useState("");
const [Password, setPassword] = useState("");
const [FirstName, setFirstName] = useState("");
const [LastName, setLastName] = useState("");
const [Email, setEmail] = useState("");


const [loginStats, setLoginStatus] = useState("");



const register = () => {
  axios.post("http://192.168.1.112:5001/register ", {
    ID:ID,
    UserName: UserName,
    Password: Password,
    FirstName: FirstName,
    LastName: LastName,
    Email: Email,
     }).then (() =>{
      alert("Successful insert");
     });
};
  
const login = () =>  {
  axios.post("http://192.168.1.112:5001/login",{
    UserName: UserName,
    Password: Password,

  }).then((response) => {

    if (response.data.message) {
      setLoginStatus(response.data.message);
    }
    else {
      console.log("Login Successful");
      navigate('/home.js')
      setLoginStatus(response.data[0].UserName);
    }
  });
};


  return (
   <div className='App'>
    <h1>Registration</h1>

    <div className="form">
      <label>ID</label>
   <input type="text" name="ID" onChange={(e)=>{
    setID(e.target.value)
   }} 
   />
        <label>UserName</label>-
   <input type="text" name="UserName" onChange={(e)=>{
    setUserName(e.target.value)
   }} 
   />
   <label>Password</label>
   <input type="text" name="Password" onChange={(e)=>{
    setPassword(e.target.value)
   }} 
   />
   <label>FirstName</label>
   <input type="text" name="FirstName" onChange={(e)=>{
    setFirstName(e.target.value)
   }} 
   />
   <label>LastName</label>
   <input type="text" name="LastName" onChange={(e)=>{
    setLastName(e.target.value)
   }} 
   />
   
   
   
   <label>Email:</label>
   <input type="text" name="Email"  onChange={(e)=>{
    setEmail(e.target.value)
   }} />

   <button onClick={register}>Submit</button>


   <div className='App'>
    <h1>Login</h1>

    <div className="form">
      <label>UserName</label>
   <input type="text" name="UserName" onChange={(e)=>{
    setUserName(e.target.value)
   }} 
   />
        <label>Password</label>-
   <input type="text" name="Password" onChange={(e)=>{
    setPassword(e.target.value)
   }} 
   />
   <button onClick={login}>Login</button>
   </div>
  
   </div>



   
   </div>
   </div>
  );
}

export default App;
