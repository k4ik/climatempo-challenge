import Header from "./components/Header.jsx"
import SearchBox from "./components/SearchBar.jsx"
import { MoveUp, MoveDown, Droplet, Umbrella } from "lucide-react"

function App() {
  return (
    <>
      <Header />
      <SearchBox />
      <main className="bg-zinc-300 h-screen">
        <p className="text-center text-xl pt-8 pb-8">Previsão para Osasco - SP</p>

        <section className="grid grid-cols-2 justify-items-center">
          <div className="flex flex-col max-w-96 w-full">
            <div className="bg-zinc-100 p-4">
              <p className="mb-4">01/02/2017</p>
              <p class="text-sm">Sol com muitas nuvens durante o dia. Períodos de nublado, com chuvas a qualquer hora.</p>
            </div>
            <div className="bg-zinc-200 grid grid-cols-2 justify-items-center gap-y-4 p-4">
              <div className="flex gap-4">
                <MoveUp />
                <span className="text-blue-600">20°C</span>
              </div>
              <div className="flex gap-4">
                <MoveDown />
                <span className="text-red-600">10°C</span>
              </div>
              <div className="flex gap-4">
                <Droplet fill="#000" />
                <span>10mm</span>
              </div>
              <div className="flex gap-4">
                <Umbrella fill="#000" />
                <span>50%</span>
              </div>
            </div>
          </div>
          <div className="flex flex-col max-w-96 w-full">
            <div className="bg-zinc-100 p-4">
              <p className="mb-4">01/02/2017</p>
              <p class="text-sm">Sol com muitas nuvens durante o dia. Períodos de nublado, com chuvas a qualquer hora.</p>
            </div>
            <div className="bg-zinc-200 grid grid-cols-2 justify-items-center gap-y-4 p-4">
              <div className="flex gap-4">
                <MoveUp />
                <span className="text-blue-600">20°C</span>
              </div>
              <div className="flex gap-4">
                <MoveDown />
                <span className="text-red-600">10°C</span>
              </div>
              <div className="flex gap-4">
                <Droplet fill="#000" />
                <span>10mm</span>
              </div>
              <div className="flex gap-4">
                <Umbrella fill="#000" />
                <span>50%</span>
              </div>
            </div>
          </div>
        </section>
      </main>
    </>
  )
}

export default App
