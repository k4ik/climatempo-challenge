import { Search } from 'lucide-react';


function SearchBox() {
    return (
        <div className="flex justify-between h-12">
            <input type="text" className="w-full outline-none px-12" />
            <button className="w-12 flex justify-center items-center">
                <Search />
            </button>
        </div>
    )
}

export default SearchBox