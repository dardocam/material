import { createBrowserRouter, RouterProvider } from "react-router-dom";
import Home from "./routes/Home";
import About from "./routes/About";
import Login from "./routes/Login";
import Dashboard from "./routes/Dashboard";
import PrivateRoute from "./components/PrivateRoute";
import { useState, createContext } from "react";

function App() {
  const [auth, setAuth] = useState(false);

  const UserContext = createContext();

  const router = createBrowserRouter([
    {
      path: "/",
      element: <Home />,
    },
    {
      path: "about",
      element: <About />,
    },
    {
      path: "login",
      element: (
        <UserContext.Provider value={auth}>
          <Login
            setAuth={(value) => {
              setAuth(value);
            }}
          />
        </UserContext.Provider>
      ),
    },
    {
      path: "dashboard",
      element: (
        <UserContext.Provider value={auth}>
          <PrivateRoute auth={{ isAuthenticated: auth }}>
            <Dashboard />
          </PrivateRoute>
        </UserContext.Provider>
      ),
    },
  ]);

  return <RouterProvider router={router} />;
}

export default App;
