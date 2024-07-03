import { Search } from 'lucide-react';
import React, {useState} from 'react';

function SearchBox({onSearch}) {
    const [query, setQuery] = useState('');

    const handleChange = (e) => {
        setQuery(e.target.value);
    }

    const handleSubmit = (e) => {
        e.preventDefault();
        onSearch(query);
    }

    return (
        <form onSubmit={handleSubmit}  className="flex justify-between h-12">
            <input type="text" className="w-full outline-none px-4" value={query} onChange={handleChange} />
            <button className="w-12 flex justify-center items-center" type="submit">
                <Search />
            </button>
        </form>
    )
}

export default SearchBox