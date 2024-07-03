import React from 'react';
import { MoveUp, MoveDown, Droplet, Umbrella } from "lucide-react";

function Card ({ data }) {
    const { date, conditionText, conditionIcon, maxTemp, minTemp, precipitation, chanceOfRain } = data;

    return (
        <>
            <div className="flex flex-col max-w-96 w-full">
                <div className="bg-zinc-100 p-4 flex flex-col items-center">
                    <p className="mb-4 self-start">{date}</p>
                    <img src={conditionIcon} alt={conditionText} />
                </div>
                <div className="bg-zinc-200 grid grid-cols-2 justify-items-center gap-y-4 p-4">
                    <div className="flex gap-4">
                        <MoveUp />
                        <span className="text-blue-600">{maxTemp}°C</span>
                    </div>
                    <div className="flex gap-4">
                        <MoveDown />
                        <span className="text-red-600">{minTemp}°C</span>
                    </div>
                    <div className="flex gap-4">
                        <Droplet fill="#000" />
                        <span>{precipitation}mm</span>
                    </div>
                    <div className="flex gap-4">
                        <Umbrella fill="#000" />
                        <span>{chanceOfRain}%</span>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Card;
