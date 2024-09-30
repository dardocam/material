import { Box } from "./components/Box/Box";
import { Rectangulo } from "./components/Rectangulo/Rectangulo";

export default function App() {

  return (
    <>
    <Rectangulo>
      <Box width={300} color="red" />

    </Rectangulo>
    <Rectangulo/>
    </>
  )
}


