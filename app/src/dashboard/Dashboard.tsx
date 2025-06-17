import React, { useEffect, useRef, useState } from "react";
import { LineChart, Line, CartesianGrid, XAxis, YAxis, Tooltip } from "recharts";
import Clock from "../shared/component/clock";
import { APIClient } from "../shared/lib";
import "./style.css";

type UserFrontEndInfo = {
	isSLT: string;
	isStaff: string;
	isDeveloper: string;
	isSuspended: string;
	isPD: string;
	isEMS: string;
	isOnLOA: string;
	id: string;
	rank: string;
	firstName: string;
	lastName: string;
	displayName: string;
	username: string;
	team: string;
	faction_rank: string;
	faction_rank_real: string;
};
type DashboardProps = {
	user: {
		info: {
			needed: boolean;
			fields_required: Array<string>;
		};
	} & UserFrontEndInfo;
	config: {
		panel: {
			enabled: boolean;
		};
		org: {
			name: string;
		};
	};
	api: APIClient;
};

type ServerStatistics = {
	total: {
		players: number;
		police: number;
		medics: number;
		balance: string;
	};
	richlist: Array<{
		uid: number;
		playerid: string;
		name: string;
		bankacc: string;
		last_seen: string;
	}>;
};

type CaseStatObject = {
	name: string;
	value: number;
};
type CasesStatistics = {
	daily: CaseStatObject[];
	weekly: CaseStatObject[];
	monthly: CaseStatObject[];
};

export function Dashboard(props: DashboardProps) {
	const [stats, setStats] = useState<ServerStatistics>({
		total: {
			players: 0,
			police: 0,
			medics: 0,
			balance: "$000,000,000",
		},
		richlist: [],
	});
	const [cases, setCases] = useState<CasesStatistics>({
		daily: [],
		weekly: [],
		monthly: [],
	});

	useEffect(() => {
		props.api.get("/v2/statistics/game/server").then(({ data }) => {
			if (data.code === 200) {
				setStats({
					...stats,
					total: {
						players: data.response.players.total,
						police: data.response.players.total_cops,
						medics: data.response.players.total_medics,
						balance: data.response.serverBalance.formatted,
					},
					richlist: data.response.players.rich_list,
				});
			}
		});
		props.api
			.get<{
				success: boolean;
				stats: {
					daily: number[];
					weekly: number[];
					monthly: number[];
				};
			}>("/v2/statistics/cases")
			.then(({ data }) => {
				console.log(data.stats);
				if (data.success) {
					setCases({
						daily: data.stats.daily
							.map((x, ix) => {
								return { name: _colNameFor(ix, "day"), value: x };
							})
							.reverse(),
						weekly: data.stats.weekly
							.map((x, ix) => {
								return { name: _colNameFor(ix, "week"), value: x };
							})
							.reverse(),
						monthly: data.stats.monthly
							.map((x, ix) => {
								return { name: _colNameFor(ix, "month"), value: x };
							})
							.reverse(),
					});
				}
			});
	}, []);
	function _colNameFor(index: number, type: "day" | "week" | "month") {
		switch (type) {
			case "day":
				return index === 0 ? "Today" : index === 1 ? "Yesterday" : `${index} days ago`;
			case "week":
				return index === 0 ? "This Week" : index === 1 ? "Last Week" : `${index} weeks ago`;
			case "month":
				return index === 0 ? "This Month" : index === 1 ? "Last Month" : `${index} months ago`;
		}
	}

	return (
		<div className="dashboardOverlay">
			<div className="p-2 z-10">
				<h1 className="inline-block text-3xl">
					{props.user.username} <small className="font-light">{props.user.rank}</small>
				</h1>
				<h1 className="float-right inline-block">
					<Clock />
				</h1>
			</div>
			<h4 className="fixed bottom-2.5 right-2.5">{props.config.org.name} Dashboard</h4>
			{props.config.panel.enabled ? (
				<div className="mr-4">
					<div className="grid grid-cols-3 gap-2.5 my-2 ml-0">
						<div className="stat col">
							<p>Total Players</p>
							<span id="totalplayers">{stats.total.players.toString().padStart(3, "0")}</span>
						</div>
						<div className="stat col">
							<p>Total Police</p>
							<span id="totalcops">{stats.total.police.toString().padStart(3, "0")}</span>
						</div>
						<div className="stat col">
							<p>Total Medics</p>
							<span id="totalmedics">{stats.total.medics.toString().padStart(3, "0")}</span>
						</div>
					</div>
					<div className="stat">
						<p>Server Balance</p>
						<span id="serverbalance">{stats.total.balance.toLocaleString()}</span>
					</div>
					<div className="stat">
						<p>Rich List</p>
						<div id="rich_list">
							{stats.richlist.map((player, idx) => (
								<div className="richListPlayer">
									No. {idx + 1}: <a href={`/game/players?query=${player.name}`}>{player.name}</a> ~ ${player.bankacc}
								</div>
							))}
						</div>
					</div>
				</div>
			) : undefined}

			<div id="staff_info" className="case_stats infoPanel">
				<div className="cool-graph daily-cases">
					<b>Daily Cases</b>
					<LineChart width={600} height={300} data={cases.daily} margin={{ top: 5, right: 20, bottom: 5, left: 0 }}>
						<Line type="monotone" dataKey="value" stroke="#8884d8" />
						<XAxis dataKey="name" />
						<YAxis />
						<Tooltip labelStyle={{ color: "black" }} />
					</LineChart>
				</div>
				<div className="cool-graph weekly-cases">
					<b>Weekly Cases</b>
					<LineChart width={600} height={300} data={cases.weekly} margin={{ top: 5, right: 20, bottom: 5, left: 0 }}>
						<Line type="monotone" dataKey="value" stroke="#8884d8" />
						<XAxis dataKey="name" />
						<YAxis />
						<Tooltip labelStyle={{ color: "black" }} />
					</LineChart>
				</div>
				<div className="cool-graph weekly-cases">
					<b>Monthly Cases</b>
					<LineChart width={600} height={300} data={cases.monthly} margin={{ top: 5, right: 20, bottom: 5, left: 0 }}>
						<Line type="monotone" dataKey="value" stroke="#8884d8" />
						{/* <CartesianGrid stroke="#ccc" strokeDasharray="5 5" /> */}
						<XAxis dataKey="name" />
						<YAxis />
						<Tooltip labelStyle={{ color: "black" }} />
					</LineChart>
				</div>
			</div>
		</div>
	);
}
